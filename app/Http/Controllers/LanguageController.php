<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Repositories\LanguageRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Laracasts\Flash\Flash;

class LanguageController extends AppBaseController
{
    /** @var LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.languages.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLanguageRequest  $request
     * @return JsonResponse
     */
    public function store(CreateLanguageRequest $request): JsonResponse
    {
        $input = $request->all();
        $language = $this->languageRepository->create($input);
        $translation = $this->languageRepository->translationFileCreate($language);

        return $this->sendResponse($language, 'Language Saved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Language  $language
     * @return JsonResponse
     */
    public function edit(Language $language)
    {
        return $this->sendResponse($language, 'Language Retrieved Successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Language  $language
     * @return JsonResponse
     */
    public function show(Language $language)
    {
        return $this->sendResponse($language, 'Language Retrieved Successfully.');
    }

    /**
     * @param  UpdateLanguageRequest  $request
     * @param  Language  $language
     * @return JsonResponse
     */
    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $input = $request->all();

        $this->languageRepository->update($input, $language->id);

        return $this->sendSuccess('Language Updated Successfully.');
    }

    /**
     * @param  Language  $language
     * @return mixed
     */
    public function destroy(Language $language)
    {
        if ($language->is_default == true) {
            return $this->sendError('Default Language can\'t be deleted.');
        }

        $path = base_path('lang/').$language->iso_code;
        if (\File::exists($path)) {
            \File::deleteDirectory($path);
        }
        $language->delete();
        Artisan::call('lang:js');

        return $this->sendSuccess('Language Deleted Successfully.');
    }

    /**
     * @param  Language  $language
     * @param  Request  $request
     * @return Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function showTranslation(Language $language, Request $request)
    {
        $selectedLang = $request->get('name', $language->iso_code);
        $selectedFile = $request->get('file', 'messages.php');
        $langExists = $this->languageRepository->checkLanguageExistOrNot($selectedLang);
        if (! $langExists) {
            return redirect()->back()->withErrors($selectedLang.' language not found.');
        }

        $fileExists = $this->languageRepository->checkFileExistOrNot($selectedLang, $selectedFile);
        if (! $fileExists) {
            return redirect()->back()->withErrors($selectedFile.' file not found.');
        }

        $oldLang = app()->getLocale();
        $data = $this->languageRepository->getSubDirectoryFiles($selectedLang, $selectedFile);
        $data['id'] = $language->id;
        app()->setLocale($oldLang);

        return view('admin.languages.translation-manager.index', compact('selectedLang', 'selectedFile'))->with($data);
    }

    /**
     * @param  Language  $language
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function updateTranslation(Language $language, Request $request): RedirectResponse
    {
        $lName = $language->iso_code;
        $fileName = $request->get('file_name');
        $fileExists = $this->languageRepository->checkFileExistOrNot($lName, $fileName);

        if (! $fileExists) {
            return redirect()->back()->withErrors('File not found.');
        }

        if (! empty($lName)) {
            $result = $request->except(['_token', 'translate_language', 'file_name']);

            File::put(base_path('lang/').$lName.'/'.$fileName, '<?php return '.var_export($result, true).'?>');
        }
        Artisan::call('lang:js');

        Flash::success('Language updated successfully.');

        return redirect()->route('languages.translation', $language->id);
    }
}
