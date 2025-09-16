/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@hotwired/turbo/dist/turbo.es2017-esm.js":
/*!***************************************************************!*\
  !*** ./node_modules/@hotwired/turbo/dist/turbo.es2017-esm.js ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PageRenderer": () => (/* binding */ PageRenderer),
/* harmony export */   "PageSnapshot": () => (/* binding */ PageSnapshot),
/* harmony export */   "clearCache": () => (/* binding */ clearCache),
/* harmony export */   "connectStreamSource": () => (/* binding */ connectStreamSource),
/* harmony export */   "disconnectStreamSource": () => (/* binding */ disconnectStreamSource),
/* harmony export */   "navigator": () => (/* binding */ navigator$1),
/* harmony export */   "registerAdapter": () => (/* binding */ registerAdapter),
/* harmony export */   "renderStreamMessage": () => (/* binding */ renderStreamMessage),
/* harmony export */   "session": () => (/* binding */ session),
/* harmony export */   "setConfirmMethod": () => (/* binding */ setConfirmMethod),
/* harmony export */   "setProgressBarDelay": () => (/* binding */ setProgressBarDelay),
/* harmony export */   "start": () => (/* binding */ start),
/* harmony export */   "visit": () => (/* binding */ visit)
/* harmony export */ });
/*
Turbo 7.1.0
Copyright © 2021 Basecamp, LLC
 */
(function () {
    if (window.Reflect === undefined || window.customElements === undefined ||
        window.customElements.polyfillWrapFlushCallback) {
        return;
    }
    const BuiltInHTMLElement = HTMLElement;
    const wrapperForTheName = {
        'HTMLElement': function HTMLElement() {
            return Reflect.construct(BuiltInHTMLElement, [], this.constructor);
        }
    };
    window.HTMLElement =
        wrapperForTheName['HTMLElement'];
    HTMLElement.prototype = BuiltInHTMLElement.prototype;
    HTMLElement.prototype.constructor = HTMLElement;
    Object.setPrototypeOf(HTMLElement, BuiltInHTMLElement);
})();

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2019 Javan Makhmali
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

(function(prototype) {
  if (typeof prototype.requestSubmit == "function") return

  prototype.requestSubmit = function(submitter) {
    if (submitter) {
      validateSubmitter(submitter, this);
      submitter.click();
    } else {
      submitter = document.createElement("input");
      submitter.type = "submit";
      submitter.hidden = true;
      this.appendChild(submitter);
      submitter.click();
      this.removeChild(submitter);
    }
  };

  function validateSubmitter(submitter, form) {
    submitter instanceof HTMLElement || raise(TypeError, "parameter 1 is not of type 'HTMLElement'");
    submitter.type == "submit" || raise(TypeError, "The specified element is not a submit button");
    submitter.form == form || raise(DOMException, "The specified element is not owned by this form element", "NotFoundError");
  }

  function raise(errorConstructor, message, name) {
    throw new errorConstructor("Failed to execute 'requestSubmit' on 'HTMLFormElement': " + message + ".", name)
  }
})(HTMLFormElement.prototype);

const submittersByForm = new WeakMap;
function findSubmitterFromClickTarget(target) {
    const element = target instanceof Element ? target : target instanceof Node ? target.parentElement : null;
    const candidate = element ? element.closest("input, button") : null;
    return (candidate === null || candidate === void 0 ? void 0 : candidate.type) == "submit" ? candidate : null;
}
function clickCaptured(event) {
    const submitter = findSubmitterFromClickTarget(event.target);
    if (submitter && submitter.form) {
        submittersByForm.set(submitter.form, submitter);
    }
}
(function () {
    if ("submitter" in Event.prototype)
        return;
    let prototype;
    if ("SubmitEvent" in window && /Apple Computer/.test(navigator.vendor)) {
        prototype = window.SubmitEvent.prototype;
    }
    else if ("SubmitEvent" in window) {
        return;
    }
    else {
        prototype = window.Event.prototype;
    }
    addEventListener("click", clickCaptured, true);
    Object.defineProperty(prototype, "submitter", {
        get() {
            if (this.type == "submit" && this.target instanceof HTMLFormElement) {
                return submittersByForm.get(this.target);
            }
        }
    });
})();

var FrameLoadingStyle;
(function (FrameLoadingStyle) {
    FrameLoadingStyle["eager"] = "eager";
    FrameLoadingStyle["lazy"] = "lazy";
})(FrameLoadingStyle || (FrameLoadingStyle = {}));
class FrameElement extends HTMLElement {
    constructor() {
        super();
        this.loaded = Promise.resolve();
        this.delegate = new FrameElement.delegateConstructor(this);
    }
    static get observedAttributes() {
        return ["disabled", "loading", "src"];
    }
    connectedCallback() {
        this.delegate.connect();
    }
    disconnectedCallback() {
        this.delegate.disconnect();
    }
    reload() {
        const { src } = this;
        this.src = null;
        this.src = src;
    }
    attributeChangedCallback(name) {
        if (name == "loading") {
            this.delegate.loadingStyleChanged();
        }
        else if (name == "src") {
            this.delegate.sourceURLChanged();
        }
        else {
            this.delegate.disabledChanged();
        }
    }
    get src() {
        return this.getAttribute("src");
    }
    set src(value) {
        if (value) {
            this.setAttribute("src", value);
        }
        else {
            this.removeAttribute("src");
        }
    }
    get loading() {
        return frameLoadingStyleFromString(this.getAttribute("loading") || "");
    }
    set loading(value) {
        if (value) {
            this.setAttribute("loading", value);
        }
        else {
            this.removeAttribute("loading");
        }
    }
    get disabled() {
        return this.hasAttribute("disabled");
    }
    set disabled(value) {
        if (value) {
            this.setAttribute("disabled", "");
        }
        else {
            this.removeAttribute("disabled");
        }
    }
    get autoscroll() {
        return this.hasAttribute("autoscroll");
    }
    set autoscroll(value) {
        if (value) {
            this.setAttribute("autoscroll", "");
        }
        else {
            this.removeAttribute("autoscroll");
        }
    }
    get complete() {
        return !this.delegate.isLoading;
    }
    get isActive() {
        return this.ownerDocument === document && !this.isPreview;
    }
    get isPreview() {
        var _a, _b;
        return (_b = (_a = this.ownerDocument) === null || _a === void 0 ? void 0 : _a.documentElement) === null || _b === void 0 ? void 0 : _b.hasAttribute("data-turbo-preview");
    }
}
function frameLoadingStyleFromString(style) {
    switch (style.toLowerCase()) {
        case "lazy": return FrameLoadingStyle.lazy;
        default: return FrameLoadingStyle.eager;
    }
}

function expandURL(locatable) {
    return new URL(locatable.toString(), document.baseURI);
}
function getAnchor(url) {
    let anchorMatch;
    if (url.hash) {
        return url.hash.slice(1);
    }
    else if (anchorMatch = url.href.match(/#(.*)$/)) {
        return anchorMatch[1];
    }
}
function getAction(form, submitter) {
    const action = (submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("formaction")) || form.getAttribute("action") || form.action;
    return expandURL(action);
}
function getExtension(url) {
    return (getLastPathComponent(url).match(/\.[^.]*$/) || [])[0] || "";
}
function isHTML(url) {
    return !!getExtension(url).match(/^(?:|\.(?:htm|html|xhtml))$/);
}
function isPrefixedBy(baseURL, url) {
    const prefix = getPrefix(url);
    return baseURL.href === expandURL(prefix).href || baseURL.href.startsWith(prefix);
}
function locationIsVisitable(location, rootLocation) {
    return isPrefixedBy(location, rootLocation) && isHTML(location);
}
function getRequestURL(url) {
    const anchor = getAnchor(url);
    return anchor != null
        ? url.href.slice(0, -(anchor.length + 1))
        : url.href;
}
function toCacheKey(url) {
    return getRequestURL(url);
}
function urlsAreEqual(left, right) {
    return expandURL(left).href == expandURL(right).href;
}
function getPathComponents(url) {
    return url.pathname.split("/").slice(1);
}
function getLastPathComponent(url) {
    return getPathComponents(url).slice(-1)[0];
}
function getPrefix(url) {
    return addTrailingSlash(url.origin + url.pathname);
}
function addTrailingSlash(value) {
    return value.endsWith("/") ? value : value + "/";
}

class FetchResponse {
    constructor(response) {
        this.response = response;
    }
    get succeeded() {
        return this.response.ok;
    }
    get failed() {
        return !this.succeeded;
    }
    get clientError() {
        return this.statusCode >= 400 && this.statusCode <= 499;
    }
    get serverError() {
        return this.statusCode >= 500 && this.statusCode <= 599;
    }
    get redirected() {
        return this.response.redirected;
    }
    get location() {
        return expandURL(this.response.url);
    }
    get isHTML() {
        return this.contentType && this.contentType.match(/^(?:text\/([^\s;,]+\b)?html|application\/xhtml\+xml)\b/);
    }
    get statusCode() {
        return this.response.status;
    }
    get contentType() {
        return this.header("Content-Type");
    }
    get responseText() {
        return this.response.clone().text();
    }
    get responseHTML() {
        if (this.isHTML) {
            return this.response.clone().text();
        }
        else {
            return Promise.resolve(undefined);
        }
    }
    header(name) {
        return this.response.headers.get(name);
    }
}

function dispatch(eventName, { target, cancelable, detail } = {}) {
    const event = new CustomEvent(eventName, { cancelable, bubbles: true, detail });
    if (target && target.isConnected) {
        target.dispatchEvent(event);
    }
    else {
        document.documentElement.dispatchEvent(event);
    }
    return event;
}
function nextAnimationFrame() {
    return new Promise(resolve => requestAnimationFrame(() => resolve()));
}
function nextEventLoopTick() {
    return new Promise(resolve => setTimeout(() => resolve(), 0));
}
function nextMicrotask() {
    return Promise.resolve();
}
function parseHTMLDocument(html = "") {
    return new DOMParser().parseFromString(html, "text/html");
}
function unindent(strings, ...values) {
    const lines = interpolate(strings, values).replace(/^\n/, "").split("\n");
    const match = lines[0].match(/^\s+/);
    const indent = match ? match[0].length : 0;
    return lines.map(line => line.slice(indent)).join("\n");
}
function interpolate(strings, values) {
    return strings.reduce((result, string, i) => {
        const value = values[i] == undefined ? "" : values[i];
        return result + string + value;
    }, "");
}
function uuid() {
    return Array.apply(null, { length: 36 }).map((_, i) => {
        if (i == 8 || i == 13 || i == 18 || i == 23) {
            return "-";
        }
        else if (i == 14) {
            return "4";
        }
        else if (i == 19) {
            return (Math.floor(Math.random() * 4) + 8).toString(16);
        }
        else {
            return Math.floor(Math.random() * 15).toString(16);
        }
    }).join("");
}
function getAttribute(attributeName, ...elements) {
    for (const value of elements.map(element => element === null || element === void 0 ? void 0 : element.getAttribute(attributeName))) {
        if (typeof value == "string")
            return value;
    }
    return null;
}
function markAsBusy(...elements) {
    for (const element of elements) {
        if (element.localName == "turbo-frame") {
            element.setAttribute("busy", "");
        }
        element.setAttribute("aria-busy", "true");
    }
}
function clearBusyState(...elements) {
    for (const element of elements) {
        if (element.localName == "turbo-frame") {
            element.removeAttribute("busy");
        }
        element.removeAttribute("aria-busy");
    }
}

var FetchMethod;
(function (FetchMethod) {
    FetchMethod[FetchMethod["get"] = 0] = "get";
    FetchMethod[FetchMethod["post"] = 1] = "post";
    FetchMethod[FetchMethod["put"] = 2] = "put";
    FetchMethod[FetchMethod["patch"] = 3] = "patch";
    FetchMethod[FetchMethod["delete"] = 4] = "delete";
})(FetchMethod || (FetchMethod = {}));
function fetchMethodFromString(method) {
    switch (method.toLowerCase()) {
        case "get": return FetchMethod.get;
        case "post": return FetchMethod.post;
        case "put": return FetchMethod.put;
        case "patch": return FetchMethod.patch;
        case "delete": return FetchMethod.delete;
    }
}
class FetchRequest {
    constructor(delegate, method, location, body = new URLSearchParams, target = null) {
        this.abortController = new AbortController;
        this.resolveRequestPromise = (value) => { };
        this.delegate = delegate;
        this.method = method;
        this.headers = this.defaultHeaders;
        this.body = body;
        this.url = location;
        this.target = target;
    }
    get location() {
        return this.url;
    }
    get params() {
        return this.url.searchParams;
    }
    get entries() {
        return this.body ? Array.from(this.body.entries()) : [];
    }
    cancel() {
        this.abortController.abort();
    }
    async perform() {
        var _a, _b;
        const { fetchOptions } = this;
        (_b = (_a = this.delegate).prepareHeadersForRequest) === null || _b === void 0 ? void 0 : _b.call(_a, this.headers, this);
        await this.allowRequestToBeIntercepted(fetchOptions);
        try {
            this.delegate.requestStarted(this);
            const response = await fetch(this.url.href, fetchOptions);
            return await this.receive(response);
        }
        catch (error) {
            if (error.name !== 'AbortError') {
                this.delegate.requestErrored(this, error);
                throw error;
            }
        }
        finally {
            this.delegate.requestFinished(this);
        }
    }
    async receive(response) {
        const fetchResponse = new FetchResponse(response);
        const event = dispatch("turbo:before-fetch-response", { cancelable: true, detail: { fetchResponse }, target: this.target });
        if (event.defaultPrevented) {
            this.delegate.requestPreventedHandlingResponse(this, fetchResponse);
        }
        else if (fetchResponse.succeeded) {
            this.delegate.requestSucceededWithResponse(this, fetchResponse);
        }
        else {
            this.delegate.requestFailedWithResponse(this, fetchResponse);
        }
        return fetchResponse;
    }
    get fetchOptions() {
        var _a;
        return {
            method: FetchMethod[this.method].toUpperCase(),
            credentials: "same-origin",
            headers: this.headers,
            redirect: "follow",
            body: this.isIdempotent ? null : this.body,
            signal: this.abortSignal,
            referrer: (_a = this.delegate.referrer) === null || _a === void 0 ? void 0 : _a.href
        };
    }
    get defaultHeaders() {
        return {
            "Accept": "text/html, application/xhtml+xml"
        };
    }
    get isIdempotent() {
        return this.method == FetchMethod.get;
    }
    get abortSignal() {
        return this.abortController.signal;
    }
    async allowRequestToBeIntercepted(fetchOptions) {
        const requestInterception = new Promise(resolve => this.resolveRequestPromise = resolve);
        const event = dispatch("turbo:before-fetch-request", {
            cancelable: true,
            detail: {
                fetchOptions,
                url: this.url,
                resume: this.resolveRequestPromise
            },
            target: this.target
        });
        if (event.defaultPrevented)
            await requestInterception;
    }
}

class AppearanceObserver {
    constructor(delegate, element) {
        this.started = false;
        this.intersect = entries => {
            const lastEntry = entries.slice(-1)[0];
            if (lastEntry === null || lastEntry === void 0 ? void 0 : lastEntry.isIntersecting) {
                this.delegate.elementAppearedInViewport(this.element);
            }
        };
        this.delegate = delegate;
        this.element = element;
        this.intersectionObserver = new IntersectionObserver(this.intersect);
    }
    start() {
        if (!this.started) {
            this.started = true;
            this.intersectionObserver.observe(this.element);
        }
    }
    stop() {
        if (this.started) {
            this.started = false;
            this.intersectionObserver.unobserve(this.element);
        }
    }
}

class StreamMessage {
    constructor(html) {
        this.templateElement = document.createElement("template");
        this.templateElement.innerHTML = html;
    }
    static wrap(message) {
        if (typeof message == "string") {
            return new this(message);
        }
        else {
            return message;
        }
    }
    get fragment() {
        const fragment = document.createDocumentFragment();
        for (const element of this.foreignElements) {
            fragment.appendChild(document.importNode(element, true));
        }
        return fragment;
    }
    get foreignElements() {
        return this.templateChildren.reduce((streamElements, child) => {
            if (child.tagName.toLowerCase() == "turbo-stream") {
                return [...streamElements, child];
            }
            else {
                return streamElements;
            }
        }, []);
    }
    get templateChildren() {
        return Array.from(this.templateElement.content.children);
    }
}
StreamMessage.contentType = "text/vnd.turbo-stream.html";

var FormSubmissionState;
(function (FormSubmissionState) {
    FormSubmissionState[FormSubmissionState["initialized"] = 0] = "initialized";
    FormSubmissionState[FormSubmissionState["requesting"] = 1] = "requesting";
    FormSubmissionState[FormSubmissionState["waiting"] = 2] = "waiting";
    FormSubmissionState[FormSubmissionState["receiving"] = 3] = "receiving";
    FormSubmissionState[FormSubmissionState["stopping"] = 4] = "stopping";
    FormSubmissionState[FormSubmissionState["stopped"] = 5] = "stopped";
})(FormSubmissionState || (FormSubmissionState = {}));
var FormEnctype;
(function (FormEnctype) {
    FormEnctype["urlEncoded"] = "application/x-www-form-urlencoded";
    FormEnctype["multipart"] = "multipart/form-data";
    FormEnctype["plain"] = "text/plain";
})(FormEnctype || (FormEnctype = {}));
function formEnctypeFromString(encoding) {
    switch (encoding.toLowerCase()) {
        case FormEnctype.multipart: return FormEnctype.multipart;
        case FormEnctype.plain: return FormEnctype.plain;
        default: return FormEnctype.urlEncoded;
    }
}
class FormSubmission {
    constructor(delegate, formElement, submitter, mustRedirect = false) {
        this.state = FormSubmissionState.initialized;
        this.delegate = delegate;
        this.formElement = formElement;
        this.submitter = submitter;
        this.formData = buildFormData(formElement, submitter);
        this.location = expandURL(this.action);
        if (this.method == FetchMethod.get) {
            mergeFormDataEntries(this.location, [...this.body.entries()]);
        }
        this.fetchRequest = new FetchRequest(this, this.method, this.location, this.body, this.formElement);
        this.mustRedirect = mustRedirect;
    }
    static confirmMethod(message, element) {
        return confirm(message);
    }
    get method() {
        var _a;
        const method = ((_a = this.submitter) === null || _a === void 0 ? void 0 : _a.getAttribute("formmethod")) || this.formElement.getAttribute("method") || "";
        return fetchMethodFromString(method.toLowerCase()) || FetchMethod.get;
    }
    get action() {
        var _a;
        const formElementAction = typeof this.formElement.action === 'string' ? this.formElement.action : null;
        return ((_a = this.submitter) === null || _a === void 0 ? void 0 : _a.getAttribute("formaction")) || this.formElement.getAttribute("action") || formElementAction || "";
    }
    get body() {
        if (this.enctype == FormEnctype.urlEncoded || this.method == FetchMethod.get) {
            return new URLSearchParams(this.stringFormData);
        }
        else {
            return this.formData;
        }
    }
    get enctype() {
        var _a;
        return formEnctypeFromString(((_a = this.submitter) === null || _a === void 0 ? void 0 : _a.getAttribute("formenctype")) || this.formElement.enctype);
    }
    get isIdempotent() {
        return this.fetchRequest.isIdempotent;
    }
    get stringFormData() {
        return [...this.formData].reduce((entries, [name, value]) => {
            return entries.concat(typeof value == "string" ? [[name, value]] : []);
        }, []);
    }
    get confirmationMessage() {
        return this.formElement.getAttribute("data-turbo-confirm");
    }
    get needsConfirmation() {
        return this.confirmationMessage !== null;
    }
    async start() {
        const { initialized, requesting } = FormSubmissionState;
        if (this.needsConfirmation) {
            const answer = FormSubmission.confirmMethod(this.confirmationMessage, this.formElement);
            if (!answer) {
                return;
            }
        }
        if (this.state == initialized) {
            this.state = requesting;
            return this.fetchRequest.perform();
        }
    }
    stop() {
        const { stopping, stopped } = FormSubmissionState;
        if (this.state != stopping && this.state != stopped) {
            this.state = stopping;
            this.fetchRequest.cancel();
            return true;
        }
    }
    prepareHeadersForRequest(headers, request) {
        if (!request.isIdempotent) {
            const token = getCookieValue(getMetaContent("csrf-param")) || getMetaContent("csrf-token");
            if (token) {
                headers["X-CSRF-Token"] = token;
            }
            headers["Accept"] = [StreamMessage.contentType, headers["Accept"]].join(", ");
        }
    }
    requestStarted(request) {
        var _a;
        this.state = FormSubmissionState.waiting;
        (_a = this.submitter) === null || _a === void 0 ? void 0 : _a.setAttribute("disabled", "");
        dispatch("turbo:submit-start", { target: this.formElement, detail: { formSubmission: this } });
        this.delegate.formSubmissionStarted(this);
    }
    requestPreventedHandlingResponse(request, response) {
        this.result = { success: response.succeeded, fetchResponse: response };
    }
    requestSucceededWithResponse(request, response) {
        if (response.clientError || response.serverError) {
            this.delegate.formSubmissionFailedWithResponse(this, response);
        }
        else if (this.requestMustRedirect(request) && responseSucceededWithoutRedirect(response)) {
            const error = new Error("Form responses must redirect to another location");
            this.delegate.formSubmissionErrored(this, error);
        }
        else {
            this.state = FormSubmissionState.receiving;
            this.result = { success: true, fetchResponse: response };
            this.delegate.formSubmissionSucceededWithResponse(this, response);
        }
    }
    requestFailedWithResponse(request, response) {
        this.result = { success: false, fetchResponse: response };
        this.delegate.formSubmissionFailedWithResponse(this, response);
    }
    requestErrored(request, error) {
        this.result = { success: false, error };
        this.delegate.formSubmissionErrored(this, error);
    }
    requestFinished(request) {
        var _a;
        this.state = FormSubmissionState.stopped;
        (_a = this.submitter) === null || _a === void 0 ? void 0 : _a.removeAttribute("disabled");
        dispatch("turbo:submit-end", { target: this.formElement, detail: Object.assign({ formSubmission: this }, this.result) });
        this.delegate.formSubmissionFinished(this);
    }
    requestMustRedirect(request) {
        return !request.isIdempotent && this.mustRedirect;
    }
}
function buildFormData(formElement, submitter) {
    const formData = new FormData(formElement);
    const name = submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("name");
    const value = submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("value");
    if (name && value != null && formData.get(name) != value) {
        formData.append(name, value);
    }
    return formData;
}
function getCookieValue(cookieName) {
    if (cookieName != null) {
        const cookies = document.cookie ? document.cookie.split("; ") : [];
        const cookie = cookies.find((cookie) => cookie.startsWith(cookieName));
        if (cookie) {
            const value = cookie.split("=").slice(1).join("=");
            return value ? decodeURIComponent(value) : undefined;
        }
    }
}
function getMetaContent(name) {
    const element = document.querySelector(`meta[name="${name}"]`);
    return element && element.content;
}
function responseSucceededWithoutRedirect(response) {
    return response.statusCode == 200 && !response.redirected;
}
function mergeFormDataEntries(url, entries) {
    const searchParams = new URLSearchParams;
    for (const [name, value] of entries) {
        if (value instanceof File)
            continue;
        searchParams.append(name, value);
    }
    url.search = searchParams.toString();
    return url;
}

class Snapshot {
    constructor(element) {
        this.element = element;
    }
    get children() {
        return [...this.element.children];
    }
    hasAnchor(anchor) {
        return this.getElementForAnchor(anchor) != null;
    }
    getElementForAnchor(anchor) {
        return anchor ? this.element.querySelector(`[id='${anchor}'], a[name='${anchor}']`) : null;
    }
    get isConnected() {
        return this.element.isConnected;
    }
    get firstAutofocusableElement() {
        return this.element.querySelector("[autofocus]");
    }
    get permanentElements() {
        return [...this.element.querySelectorAll("[id][data-turbo-permanent]")];
    }
    getPermanentElementById(id) {
        return this.element.querySelector(`#${id}[data-turbo-permanent]`);
    }
    getPermanentElementMapForSnapshot(snapshot) {
        const permanentElementMap = {};
        for (const currentPermanentElement of this.permanentElements) {
            const { id } = currentPermanentElement;
            const newPermanentElement = snapshot.getPermanentElementById(id);
            if (newPermanentElement) {
                permanentElementMap[id] = [currentPermanentElement, newPermanentElement];
            }
        }
        return permanentElementMap;
    }
}

class FormInterceptor {
    constructor(delegate, element) {
        this.submitBubbled = ((event) => {
            const form = event.target;
            if (!event.defaultPrevented && form instanceof HTMLFormElement && form.closest("turbo-frame, html") == this.element) {
                const submitter = event.submitter || undefined;
                const method = (submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("formmethod")) || form.method;
                if (method != "dialog" && this.delegate.shouldInterceptFormSubmission(form, submitter)) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    this.delegate.formSubmissionIntercepted(form, submitter);
                }
            }
        });
        this.delegate = delegate;
        this.element = element;
    }
    start() {
        this.element.addEventListener("submit", this.submitBubbled);
    }
    stop() {
        this.element.removeEventListener("submit", this.submitBubbled);
    }
}

class View {
    constructor(delegate, element) {
        this.resolveRenderPromise = (value) => { };
        this.resolveInterceptionPromise = (value) => { };
        this.delegate = delegate;
        this.element = element;
    }
    scrollToAnchor(anchor) {
        const element = this.snapshot.getElementForAnchor(anchor);
        if (element) {
            this.scrollToElement(element);
            this.focusElement(element);
        }
        else {
            this.scrollToPosition({ x: 0, y: 0 });
        }
    }
    scrollToAnchorFromLocation(location) {
        this.scrollToAnchor(getAnchor(location));
    }
    scrollToElement(element) {
        element.scrollIntoView();
    }
    focusElement(element) {
        if (element instanceof HTMLElement) {
            if (element.hasAttribute("tabindex")) {
                element.focus();
            }
            else {
                element.setAttribute("tabindex", "-1");
                element.focus();
                element.removeAttribute("tabindex");
            }
        }
    }
    scrollToPosition({ x, y }) {
        this.scrollRoot.scrollTo(x, y);
    }
    scrollToTop() {
        this.scrollToPosition({ x: 0, y: 0 });
    }
    get scrollRoot() {
        return window;
    }
    async render(renderer) {
        const { isPreview, shouldRender, newSnapshot: snapshot } = renderer;
        if (shouldRender) {
            try {
                this.renderPromise = new Promise(resolve => this.resolveRenderPromise = resolve);
                this.renderer = renderer;
                this.prepareToRenderSnapshot(renderer);
                const renderInterception = new Promise(resolve => this.resolveInterceptionPromise = resolve);
                const immediateRender = this.delegate.allowsImmediateRender(snapshot, this.resolveInterceptionPromise);
                if (!immediateRender)
                    await renderInterception;
                await this.renderSnapshot(renderer);
                this.delegate.viewRenderedSnapshot(snapshot, isPreview);
                this.finishRenderingSnapshot(renderer);
            }
            finally {
                delete this.renderer;
                this.resolveRenderPromise(undefined);
                delete this.renderPromise;
            }
        }
        else {
            this.invalidate();
        }
    }
    invalidate() {
        this.delegate.viewInvalidated();
    }
    prepareToRenderSnapshot(renderer) {
        this.markAsPreview(renderer.isPreview);
        renderer.prepareToRender();
    }
    markAsPreview(isPreview) {
        if (isPreview) {
            this.element.setAttribute("data-turbo-preview", "");
        }
        else {
            this.element.removeAttribute("data-turbo-preview");
        }
    }
    async renderSnapshot(renderer) {
        await renderer.render();
    }
    finishRenderingSnapshot(renderer) {
        renderer.finishRendering();
    }
}

class FrameView extends View {
    invalidate() {
        this.element.innerHTML = "";
    }
    get snapshot() {
        return new Snapshot(this.element);
    }
}

class LinkInterceptor {
    constructor(delegate, element) {
        this.clickBubbled = (event) => {
            if (this.respondsToEventTarget(event.target)) {
                this.clickEvent = event;
            }
            else {
                delete this.clickEvent;
            }
        };
        this.linkClicked = ((event) => {
            if (this.clickEvent && this.respondsToEventTarget(event.target) && event.target instanceof Element) {
                if (this.delegate.shouldInterceptLinkClick(event.target, event.detail.url)) {
                    this.clickEvent.preventDefault();
                    event.preventDefault();
                    this.delegate.linkClickIntercepted(event.target, event.detail.url);
                }
            }
            delete this.clickEvent;
        });
        this.willVisit = () => {
            delete this.clickEvent;
        };
        this.delegate = delegate;
        this.element = element;
    }
    start() {
        this.element.addEventListener("click", this.clickBubbled);
        document.addEventListener("turbo:click", this.linkClicked);
        document.addEventListener("turbo:before-visit", this.willVisit);
    }
    stop() {
        this.element.removeEventListener("click", this.clickBubbled);
        document.removeEventListener("turbo:click", this.linkClicked);
        document.removeEventListener("turbo:before-visit", this.willVisit);
    }
    respondsToEventTarget(target) {
        const element = target instanceof Element
            ? target
            : target instanceof Node
                ? target.parentElement
                : null;
        return element && element.closest("turbo-frame, html") == this.element;
    }
}

class Bardo {
    constructor(permanentElementMap) {
        this.permanentElementMap = permanentElementMap;
    }
    static preservingPermanentElements(permanentElementMap, callback) {
        const bardo = new this(permanentElementMap);
        bardo.enter();
        callback();
        bardo.leave();
    }
    enter() {
        for (const id in this.permanentElementMap) {
            const [, newPermanentElement] = this.permanentElementMap[id];
            this.replaceNewPermanentElementWithPlaceholder(newPermanentElement);
        }
    }
    leave() {
        for (const id in this.permanentElementMap) {
            const [currentPermanentElement] = this.permanentElementMap[id];
            this.replaceCurrentPermanentElementWithClone(currentPermanentElement);
            this.replacePlaceholderWithPermanentElement(currentPermanentElement);
        }
    }
    replaceNewPermanentElementWithPlaceholder(permanentElement) {
        const placeholder = createPlaceholderForPermanentElement(permanentElement);
        permanentElement.replaceWith(placeholder);
    }
    replaceCurrentPermanentElementWithClone(permanentElement) {
        const clone = permanentElement.cloneNode(true);
        permanentElement.replaceWith(clone);
    }
    replacePlaceholderWithPermanentElement(permanentElement) {
        const placeholder = this.getPlaceholderById(permanentElement.id);
        placeholder === null || placeholder === void 0 ? void 0 : placeholder.replaceWith(permanentElement);
    }
    getPlaceholderById(id) {
        return this.placeholders.find(element => element.content == id);
    }
    get placeholders() {
        return [...document.querySelectorAll("meta[name=turbo-permanent-placeholder][content]")];
    }
}
function createPlaceholderForPermanentElement(permanentElement) {
    const element = document.createElement("meta");
    element.setAttribute("name", "turbo-permanent-placeholder");
    element.setAttribute("content", permanentElement.id);
    return element;
}

class Renderer {
    constructor(currentSnapshot, newSnapshot, isPreview, willRender = true) {
        this.currentSnapshot = currentSnapshot;
        this.newSnapshot = newSnapshot;
        this.isPreview = isPreview;
        this.willRender = willRender;
        this.promise = new Promise((resolve, reject) => this.resolvingFunctions = { resolve, reject });
    }
    get shouldRender() {
        return true;
    }
    prepareToRender() {
        return;
    }
    finishRendering() {
        if (this.resolvingFunctions) {
            this.resolvingFunctions.resolve();
            delete this.resolvingFunctions;
        }
    }
    createScriptElement(element) {
        if (element.getAttribute("data-turbo-eval") == "false") {
            return element;
        }
        else {
            const createdScriptElement = document.createElement("script");
            if (this.cspNonce) {
                createdScriptElement.nonce = this.cspNonce;
            }
            createdScriptElement.textContent = element.textContent;
            createdScriptElement.async = false;
            copyElementAttributes(createdScriptElement, element);
            return createdScriptElement;
        }
    }
    preservingPermanentElements(callback) {
        Bardo.preservingPermanentElements(this.permanentElementMap, callback);
    }
    focusFirstAutofocusableElement() {
        const element = this.connectedSnapshot.firstAutofocusableElement;
        if (elementIsFocusable(element)) {
            element.focus();
        }
    }
    get connectedSnapshot() {
        return this.newSnapshot.isConnected ? this.newSnapshot : this.currentSnapshot;
    }
    get currentElement() {
        return this.currentSnapshot.element;
    }
    get newElement() {
        return this.newSnapshot.element;
    }
    get permanentElementMap() {
        return this.currentSnapshot.getPermanentElementMapForSnapshot(this.newSnapshot);
    }
    get cspNonce() {
        var _a;
        return (_a = document.head.querySelector('meta[name="csp-nonce"]')) === null || _a === void 0 ? void 0 : _a.getAttribute("content");
    }
}
function copyElementAttributes(destinationElement, sourceElement) {
    for (const { name, value } of [...sourceElement.attributes]) {
        destinationElement.setAttribute(name, value);
    }
}
function elementIsFocusable(element) {
    return element && typeof element.focus == "function";
}

class FrameRenderer extends Renderer {
    get shouldRender() {
        return true;
    }
    async render() {
        await nextAnimationFrame();
        this.preservingPermanentElements(() => {
            this.loadFrameElement();
        });
        this.scrollFrameIntoView();
        await nextAnimationFrame();
        this.focusFirstAutofocusableElement();
        await nextAnimationFrame();
        this.activateScriptElements();
    }
    loadFrameElement() {
        var _a;
        const destinationRange = document.createRange();
        destinationRange.selectNodeContents(this.currentElement);
        destinationRange.deleteContents();
        const frameElement = this.newElement;
        const sourceRange = (_a = frameElement.ownerDocument) === null || _a === void 0 ? void 0 : _a.createRange();
        if (sourceRange) {
            sourceRange.selectNodeContents(frameElement);
            this.currentElement.appendChild(sourceRange.extractContents());
        }
    }
    scrollFrameIntoView() {
        if (this.currentElement.autoscroll || this.newElement.autoscroll) {
            const element = this.currentElement.firstElementChild;
            const block = readScrollLogicalPosition(this.currentElement.getAttribute("data-autoscroll-block"), "end");
            if (element) {
                element.scrollIntoView({ block });
                return true;
            }
        }
        return false;
    }
    activateScriptElements() {
        for (const inertScriptElement of this.newScriptElements) {
            const activatedScriptElement = this.createScriptElement(inertScriptElement);
            inertScriptElement.replaceWith(activatedScriptElement);
        }
    }
    get newScriptElements() {
        return this.currentElement.querySelectorAll("script");
    }
}
function readScrollLogicalPosition(value, defaultValue) {
    if (value == "end" || value == "start" || value == "center" || value == "nearest") {
        return value;
    }
    else {
        return defaultValue;
    }
}

class ProgressBar {
    constructor() {
        this.hiding = false;
        this.value = 0;
        this.visible = false;
        this.trickle = () => {
            this.setValue(this.value + Math.random() / 100);
        };
        this.stylesheetElement = this.createStylesheetElement();
        this.progressElement = this.createProgressElement();
        this.installStylesheetElement();
        this.setValue(0);
    }
    static get defaultCSS() {
        return unindent `
      .turbo-progress-bar {
        position: fixed;
        display: block;
        top: 0;
        left: 0;
        height: 3px;
        background: #0076ff;
        z-index: 9999;
        transition:
          width ${ProgressBar.animationDuration}ms ease-out,
          opacity ${ProgressBar.animationDuration / 2}ms ${ProgressBar.animationDuration / 2}ms ease-in;
        transform: translate3d(0, 0, 0);
      }
    `;
    }
    show() {
        if (!this.visible) {
            this.visible = true;
            this.installProgressElement();
            this.startTrickling();
        }
    }
    hide() {
        if (this.visible && !this.hiding) {
            this.hiding = true;
            this.fadeProgressElement(() => {
                this.uninstallProgressElement();
                this.stopTrickling();
                this.visible = false;
                this.hiding = false;
            });
        }
    }
    setValue(value) {
        this.value = value;
        this.refresh();
    }
    installStylesheetElement() {
        document.head.insertBefore(this.stylesheetElement, document.head.firstChild);
    }
    installProgressElement() {
        this.progressElement.style.width = "0";
        this.progressElement.style.opacity = "1";
        document.documentElement.insertBefore(this.progressElement, document.body);
        this.refresh();
    }
    fadeProgressElement(callback) {
        this.progressElement.style.opacity = "0";
        setTimeout(callback, ProgressBar.animationDuration * 1.5);
    }
    uninstallProgressElement() {
        if (this.progressElement.parentNode) {
            document.documentElement.removeChild(this.progressElement);
        }
    }
    startTrickling() {
        if (!this.trickleInterval) {
            this.trickleInterval = window.setInterval(this.trickle, ProgressBar.animationDuration);
        }
    }
    stopTrickling() {
        window.clearInterval(this.trickleInterval);
        delete this.trickleInterval;
    }
    refresh() {
        requestAnimationFrame(() => {
            this.progressElement.style.width = `${10 + (this.value * 90)}%`;
        });
    }
    createStylesheetElement() {
        const element = document.createElement("style");
        element.type = "text/css";
        element.textContent = ProgressBar.defaultCSS;
        return element;
    }
    createProgressElement() {
        const element = document.createElement("div");
        element.className = "turbo-progress-bar";
        return element;
    }
}
ProgressBar.animationDuration = 300;

class HeadSnapshot extends Snapshot {
    constructor() {
        super(...arguments);
        this.detailsByOuterHTML = this.children
            .filter((element) => !elementIsNoscript(element))
            .map((element) => elementWithoutNonce(element))
            .reduce((result, element) => {
            const { outerHTML } = element;
            const details = outerHTML in result
                ? result[outerHTML]
                : {
                    type: elementType(element),
                    tracked: elementIsTracked(element),
                    elements: []
                };
            return Object.assign(Object.assign({}, result), { [outerHTML]: Object.assign(Object.assign({}, details), { elements: [...details.elements, element] }) });
        }, {});
    }
    get trackedElementSignature() {
        return Object.keys(this.detailsByOuterHTML)
            .filter(outerHTML => this.detailsByOuterHTML[outerHTML].tracked)
            .join("");
    }
    getScriptElementsNotInSnapshot(snapshot) {
        return this.getElementsMatchingTypeNotInSnapshot("script", snapshot);
    }
    getStylesheetElementsNotInSnapshot(snapshot) {
        return this.getElementsMatchingTypeNotInSnapshot("stylesheet", snapshot);
    }
    getElementsMatchingTypeNotInSnapshot(matchedType, snapshot) {
        return Object.keys(this.detailsByOuterHTML)
            .filter(outerHTML => !(outerHTML in snapshot.detailsByOuterHTML))
            .map(outerHTML => this.detailsByOuterHTML[outerHTML])
            .filter(({ type }) => type == matchedType)
            .map(({ elements: [element] }) => element);
    }
    get provisionalElements() {
        return Object.keys(this.detailsByOuterHTML).reduce((result, outerHTML) => {
            const { type, tracked, elements } = this.detailsByOuterHTML[outerHTML];
            if (type == null && !tracked) {
                return [...result, ...elements];
            }
            else if (elements.length > 1) {
                return [...result, ...elements.slice(1)];
            }
            else {
                return result;
            }
        }, []);
    }
    getMetaValue(name) {
        const element = this.findMetaElementByName(name);
        return element
            ? element.getAttribute("content")
            : null;
    }
    findMetaElementByName(name) {
        return Object.keys(this.detailsByOuterHTML).reduce((result, outerHTML) => {
            const { elements: [element] } = this.detailsByOuterHTML[outerHTML];
            return elementIsMetaElementWithName(element, name) ? element : result;
        }, undefined);
    }
}
function elementType(element) {
    if (elementIsScript(element)) {
        return "script";
    }
    else if (elementIsStylesheet(element)) {
        return "stylesheet";
    }
}
function elementIsTracked(element) {
    return element.getAttribute("data-turbo-track") == "reload";
}
function elementIsScript(element) {
    const tagName = element.tagName.toLowerCase();
    return tagName == "script";
}
function elementIsNoscript(element) {
    const tagName = element.tagName.toLowerCase();
    return tagName == "noscript";
}
function elementIsStylesheet(element) {
    const tagName = element.tagName.toLowerCase();
    return tagName == "style" || (tagName == "link" && element.getAttribute("rel") == "stylesheet");
}
function elementIsMetaElementWithName(element, name) {
    const tagName = element.tagName.toLowerCase();
    return tagName == "meta" && element.getAttribute("name") == name;
}
function elementWithoutNonce(element) {
    if (element.hasAttribute("nonce")) {
        element.setAttribute("nonce", "");
    }
    return element;
}

class PageSnapshot extends Snapshot {
    constructor(element, headSnapshot) {
        super(element);
        this.headSnapshot = headSnapshot;
    }
    static fromHTMLString(html = "") {
        return this.fromDocument(parseHTMLDocument(html));
    }
    static fromElement(element) {
        return this.fromDocument(element.ownerDocument);
    }
    static fromDocument({ head, body }) {
        return new this(body, new HeadSnapshot(head));
    }
    clone() {
        return new PageSnapshot(this.element.cloneNode(true), this.headSnapshot);
    }
    get headElement() {
        return this.headSnapshot.element;
    }
    get rootLocation() {
        var _a;
        const root = (_a = this.getSetting("root")) !== null && _a !== void 0 ? _a : "/";
        return expandURL(root);
    }
    get cacheControlValue() {
        return this.getSetting("cache-control");
    }
    get isPreviewable() {
        return this.cacheControlValue != "no-preview";
    }
    get isCacheable() {
        return this.cacheControlValue != "no-cache";
    }
    get isVisitable() {
        return this.getSetting("visit-control") != "reload";
    }
    getSetting(name) {
        return this.headSnapshot.getMetaValue(`turbo-${name}`);
    }
}

var TimingMetric;
(function (TimingMetric) {
    TimingMetric["visitStart"] = "visitStart";
    TimingMetric["requestStart"] = "requestStart";
    TimingMetric["requestEnd"] = "requestEnd";
    TimingMetric["visitEnd"] = "visitEnd";
})(TimingMetric || (TimingMetric = {}));
var VisitState;
(function (VisitState) {
    VisitState["initialized"] = "initialized";
    VisitState["started"] = "started";
    VisitState["canceled"] = "canceled";
    VisitState["failed"] = "failed";
    VisitState["completed"] = "completed";
})(VisitState || (VisitState = {}));
const defaultOptions = {
    action: "advance",
    historyChanged: false,
    visitCachedSnapshot: () => { },
    willRender: true,
};
var SystemStatusCode;
(function (SystemStatusCode) {
    SystemStatusCode[SystemStatusCode["networkFailure"] = 0] = "networkFailure";
    SystemStatusCode[SystemStatusCode["timeoutFailure"] = -1] = "timeoutFailure";
    SystemStatusCode[SystemStatusCode["contentTypeMismatch"] = -2] = "contentTypeMismatch";
})(SystemStatusCode || (SystemStatusCode = {}));
class Visit {
    constructor(delegate, location, restorationIdentifier, options = {}) {
        this.identifier = uuid();
        this.timingMetrics = {};
        this.followedRedirect = false;
        this.historyChanged = false;
        this.scrolled = false;
        this.snapshotCached = false;
        this.state = VisitState.initialized;
        this.delegate = delegate;
        this.location = location;
        this.restorationIdentifier = restorationIdentifier || uuid();
        const { action, historyChanged, referrer, snapshotHTML, response, visitCachedSnapshot, willRender } = Object.assign(Object.assign({}, defaultOptions), options);
        this.action = action;
        this.historyChanged = historyChanged;
        this.referrer = referrer;
        this.snapshotHTML = snapshotHTML;
        this.response = response;
        this.isSamePage = this.delegate.locationWithActionIsSamePage(this.location, this.action);
        this.visitCachedSnapshot = visitCachedSnapshot;
        this.willRender = willRender;
        this.scrolled = !willRender;
    }
    get adapter() {
        return this.delegate.adapter;
    }
    get view() {
        return this.delegate.view;
    }
    get history() {
        return this.delegate.history;
    }
    get restorationData() {
        return this.history.getRestorationDataForIdentifier(this.restorationIdentifier);
    }
    get silent() {
        return this.isSamePage;
    }
    start() {
        if (this.state == VisitState.initialized) {
            this.recordTimingMetric(TimingMetric.visitStart);
            this.state = VisitState.started;
            this.adapter.visitStarted(this);
            this.delegate.visitStarted(this);
        }
    }
    cancel() {
        if (this.state == VisitState.started) {
            if (this.request) {
                this.request.cancel();
            }
            this.cancelRender();
            this.state = VisitState.canceled;
        }
    }
    complete() {
        if (this.state == VisitState.started) {
            this.recordTimingMetric(TimingMetric.visitEnd);
            this.state = VisitState.completed;
            this.adapter.visitCompleted(this);
            this.delegate.visitCompleted(this);
            this.followRedirect();
        }
    }
    fail() {
        if (this.state == VisitState.started) {
            this.state = VisitState.failed;
            this.adapter.visitFailed(this);
        }
    }
    changeHistory() {
        var _a;
        if (!this.historyChanged) {
            const actionForHistory = this.location.href === ((_a = this.referrer) === null || _a === void 0 ? void 0 : _a.href) ? "replace" : this.action;
            const method = this.getHistoryMethodForAction(actionForHistory);
            this.history.update(method, this.location, this.restorationIdentifier);
            this.historyChanged = true;
        }
    }
    issueRequest() {
        if (this.hasPreloadedResponse()) {
            this.simulateRequest();
        }
        else if (this.shouldIssueRequest() && !this.request) {
            this.request = new FetchRequest(this, FetchMethod.get, this.location);
            this.request.perform();
        }
    }
    simulateRequest() {
        if (this.response) {
            this.startRequest();
            this.recordResponse();
            this.finishRequest();
        }
    }
    startRequest() {
        this.recordTimingMetric(TimingMetric.requestStart);
        this.adapter.visitRequestStarted(this);
    }
    recordResponse(response = this.response) {
        this.response = response;
        if (response) {
            const { statusCode } = response;
            if (isSuccessful(statusCode)) {
                this.adapter.visitRequestCompleted(this);
            }
            else {
                this.adapter.visitRequestFailedWithStatusCode(this, statusCode);
            }
        }
    }
    finishRequest() {
        this.recordTimingMetric(TimingMetric.requestEnd);
        this.adapter.visitRequestFinished(this);
    }
    loadResponse() {
        if (this.response) {
            const { statusCode, responseHTML } = this.response;
            this.render(async () => {
                this.cacheSnapshot();
                if (this.view.renderPromise)
                    await this.view.renderPromise;
                if (isSuccessful(statusCode) && responseHTML != null) {
                    await this.view.renderPage(PageSnapshot.fromHTMLString(responseHTML), false, this.willRender);
                    this.adapter.visitRendered(this);
                    this.complete();
                }
                else {
                    await this.view.renderError(PageSnapshot.fromHTMLString(responseHTML));
                    this.adapter.visitRendered(this);
                    this.fail();
                }
            });
        }
    }
    getCachedSnapshot() {
        const snapshot = this.view.getCachedSnapshotForLocation(this.location) || this.getPreloadedSnapshot();
        if (snapshot && (!getAnchor(this.location) || snapshot.hasAnchor(getAnchor(this.location)))) {
            if (this.action == "restore" || snapshot.isPreviewable) {
                return snapshot;
            }
        }
    }
    getPreloadedSnapshot() {
        if (this.snapshotHTML) {
            return PageSnapshot.fromHTMLString(this.snapshotHTML);
        }
    }
    hasCachedSnapshot() {
        return this.getCachedSnapshot() != null;
    }
    loadCachedSnapshot() {
        const snapshot = this.getCachedSnapshot();
        if (snapshot) {
            const isPreview = this.shouldIssueRequest();
            this.render(async () => {
                this.cacheSnapshot();
                if (this.isSamePage) {
                    this.adapter.visitRendered(this);
                }
                else {
                    if (this.view.renderPromise)
                        await this.view.renderPromise;
                    await this.view.renderPage(snapshot, isPreview, this.willRender);
                    this.adapter.visitRendered(this);
                    if (!isPreview) {
                        this.complete();
                    }
                }
            });
        }
    }
    followRedirect() {
        var _a;
        if (this.redirectedToLocation && !this.followedRedirect && ((_a = this.response) === null || _a === void 0 ? void 0 : _a.redirected)) {
            this.adapter.visitProposedToLocation(this.redirectedToLocation, {
                action: 'replace',
                response: this.response
            });
            this.followedRedirect = true;
        }
    }
    goToSamePageAnchor() {
        if (this.isSamePage) {
            this.render(async () => {
                this.cacheSnapshot();
                this.adapter.visitRendered(this);
            });
        }
    }
    requestStarted() {
        this.startRequest();
    }
    requestPreventedHandlingResponse(request, response) {
    }
    async requestSucceededWithResponse(request, response) {
        const responseHTML = await response.responseHTML;
        const { redirected, statusCode } = response;
        if (responseHTML == undefined) {
            this.recordResponse({ statusCode: SystemStatusCode.contentTypeMismatch, redirected });
        }
        else {
            this.redirectedToLocation = response.redirected ? response.location : undefined;
            this.recordResponse({ statusCode: statusCode, responseHTML, redirected });
        }
    }
    async requestFailedWithResponse(request, response) {
        const responseHTML = await response.responseHTML;
        const { redirected, statusCode } = response;
        if (responseHTML == undefined) {
            this.recordResponse({ statusCode: SystemStatusCode.contentTypeMismatch, redirected });
        }
        else {
            this.recordResponse({ statusCode: statusCode, responseHTML, redirected });
        }
    }
    requestErrored(request, error) {
        this.recordResponse({ statusCode: SystemStatusCode.networkFailure, redirected: false });
    }
    requestFinished() {
        this.finishRequest();
    }
    performScroll() {
        if (!this.scrolled) {
            if (this.action == "restore") {
                this.scrollToRestoredPosition() || this.scrollToAnchor() || this.view.scrollToTop();
            }
            else {
                this.scrollToAnchor() || this.view.scrollToTop();
            }
            if (this.isSamePage) {
                this.delegate.visitScrolledToSamePageLocation(this.view.lastRenderedLocation, this.location);
            }
            this.scrolled = true;
        }
    }
    scrollToRestoredPosition() {
        const { scrollPosition } = this.restorationData;
        if (scrollPosition) {
            this.view.scrollToPosition(scrollPosition);
            return true;
        }
    }
    scrollToAnchor() {
        const anchor = getAnchor(this.location);
        if (anchor != null) {
            this.view.scrollToAnchor(anchor);
            return true;
        }
    }
    recordTimingMetric(metric) {
        this.timingMetrics[metric] = new Date().getTime();
    }
    getTimingMetrics() {
        return Object.assign({}, this.timingMetrics);
    }
    getHistoryMethodForAction(action) {
        switch (action) {
            case "replace": return history.replaceState;
            case "advance":
            case "restore": return history.pushState;
        }
    }
    hasPreloadedResponse() {
        return typeof this.response == "object";
    }
    shouldIssueRequest() {
        if (this.isSamePage) {
            return false;
        }
        else if (this.action == "restore") {
            return !this.hasCachedSnapshot();
        }
        else {
            return this.willRender;
        }
    }
    cacheSnapshot() {
        if (!this.snapshotCached) {
            this.view.cacheSnapshot().then(snapshot => snapshot && this.visitCachedSnapshot(snapshot));
            this.snapshotCached = true;
        }
    }
    async render(callback) {
        this.cancelRender();
        await new Promise(resolve => {
            this.frame = requestAnimationFrame(() => resolve());
        });
        await callback();
        delete this.frame;
        this.performScroll();
    }
    cancelRender() {
        if (this.frame) {
            cancelAnimationFrame(this.frame);
            delete this.frame;
        }
    }
}
function isSuccessful(statusCode) {
    return statusCode >= 200 && statusCode < 300;
}

class BrowserAdapter {
    constructor(session) {
        this.progressBar = new ProgressBar;
        this.showProgressBar = () => {
            this.progressBar.show();
        };
        this.session = session;
    }
    visitProposedToLocation(location, options) {
        this.navigator.startVisit(location, uuid(), options);
    }
    visitStarted(visit) {
        visit.loadCachedSnapshot();
        visit.issueRequest();
        visit.changeHistory();
        visit.goToSamePageAnchor();
    }
    visitRequestStarted(visit) {
        this.progressBar.setValue(0);
        if (visit.hasCachedSnapshot() || visit.action != "restore") {
            this.showVisitProgressBarAfterDelay();
        }
        else {
            this.showProgressBar();
        }
    }
    visitRequestCompleted(visit) {
        visit.loadResponse();
    }
    visitRequestFailedWithStatusCode(visit, statusCode) {
        switch (statusCode) {
            case SystemStatusCode.networkFailure:
            case SystemStatusCode.timeoutFailure:
            case SystemStatusCode.contentTypeMismatch:
                return this.reload();
            default:
                return visit.loadResponse();
        }
    }
    visitRequestFinished(visit) {
        this.progressBar.setValue(1);
        this.hideVisitProgressBar();
    }
    visitCompleted(visit) {
    }
    pageInvalidated() {
        this.reload();
    }
    visitFailed(visit) {
    }
    visitRendered(visit) {
    }
    formSubmissionStarted(formSubmission) {
        this.progressBar.setValue(0);
        this.showFormProgressBarAfterDelay();
    }
    formSubmissionFinished(formSubmission) {
        this.progressBar.setValue(1);
        this.hideFormProgressBar();
    }
    showVisitProgressBarAfterDelay() {
        this.visitProgressBarTimeout = window.setTimeout(this.showProgressBar, this.session.progressBarDelay);
    }
    hideVisitProgressBar() {
        this.progressBar.hide();
        if (this.visitProgressBarTimeout != null) {
            window.clearTimeout(this.visitProgressBarTimeout);
            delete this.visitProgressBarTimeout;
        }
    }
    showFormProgressBarAfterDelay() {
        if (this.formProgressBarTimeout == null) {
            this.formProgressBarTimeout = window.setTimeout(this.showProgressBar, this.session.progressBarDelay);
        }
    }
    hideFormProgressBar() {
        this.progressBar.hide();
        if (this.formProgressBarTimeout != null) {
            window.clearTimeout(this.formProgressBarTimeout);
            delete this.formProgressBarTimeout;
        }
    }
    reload() {
        window.location.reload();
    }
    get navigator() {
        return this.session.navigator;
    }
}

class CacheObserver {
    constructor() {
        this.started = false;
    }
    start() {
        if (!this.started) {
            this.started = true;
            addEventListener("turbo:before-cache", this.removeStaleElements, false);
        }
    }
    stop() {
        if (this.started) {
            this.started = false;
            removeEventListener("turbo:before-cache", this.removeStaleElements, false);
        }
    }
    removeStaleElements() {
        const staleElements = [...document.querySelectorAll('[data-turbo-cache="false"]')];
        for (const element of staleElements) {
            element.remove();
        }
    }
}

class FormSubmitObserver {
    constructor(delegate) {
        this.started = false;
        this.submitCaptured = () => {
            removeEventListener("submit", this.submitBubbled, false);
            addEventListener("submit", this.submitBubbled, false);
        };
        this.submitBubbled = ((event) => {
            if (!event.defaultPrevented) {
                const form = event.target instanceof HTMLFormElement ? event.target : undefined;
                const submitter = event.submitter || undefined;
                if (form) {
                    const method = (submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("formmethod")) || form.getAttribute("method");
                    if (method != "dialog" && this.delegate.willSubmitForm(form, submitter)) {
                        event.preventDefault();
                        this.delegate.formSubmitted(form, submitter);
                    }
                }
            }
        });
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            addEventListener("submit", this.submitCaptured, true);
            this.started = true;
        }
    }
    stop() {
        if (this.started) {
            removeEventListener("submit", this.submitCaptured, true);
            this.started = false;
        }
    }
}

class FrameRedirector {
    constructor(element) {
        this.element = element;
        this.linkInterceptor = new LinkInterceptor(this, element);
        this.formInterceptor = new FormInterceptor(this, element);
    }
    start() {
        this.linkInterceptor.start();
        this.formInterceptor.start();
    }
    stop() {
        this.linkInterceptor.stop();
        this.formInterceptor.stop();
    }
    shouldInterceptLinkClick(element, url) {
        return this.shouldRedirect(element);
    }
    linkClickIntercepted(element, url) {
        const frame = this.findFrameElement(element);
        if (frame) {
            frame.delegate.linkClickIntercepted(element, url);
        }
    }
    shouldInterceptFormSubmission(element, submitter) {
        return this.shouldSubmit(element, submitter);
    }
    formSubmissionIntercepted(element, submitter) {
        const frame = this.findFrameElement(element, submitter);
        if (frame) {
            frame.removeAttribute("reloadable");
            frame.delegate.formSubmissionIntercepted(element, submitter);
        }
    }
    shouldSubmit(form, submitter) {
        var _a;
        const action = getAction(form, submitter);
        const meta = this.element.ownerDocument.querySelector(`meta[name="turbo-root"]`);
        const rootLocation = expandURL((_a = meta === null || meta === void 0 ? void 0 : meta.content) !== null && _a !== void 0 ? _a : "/");
        return this.shouldRedirect(form, submitter) && locationIsVisitable(action, rootLocation);
    }
    shouldRedirect(element, submitter) {
        const frame = this.findFrameElement(element, submitter);
        return frame ? frame != element.closest("turbo-frame") : false;
    }
    findFrameElement(element, submitter) {
        const id = (submitter === null || submitter === void 0 ? void 0 : submitter.getAttribute("data-turbo-frame")) || element.getAttribute("data-turbo-frame");
        if (id && id != "_top") {
            const frame = this.element.querySelector(`#${id}:not([disabled])`);
            if (frame instanceof FrameElement) {
                return frame;
            }
        }
    }
}

class History {
    constructor(delegate) {
        this.restorationIdentifier = uuid();
        this.restorationData = {};
        this.started = false;
        this.pageLoaded = false;
        this.onPopState = (event) => {
            if (this.shouldHandlePopState()) {
                const { turbo } = event.state || {};
                if (turbo) {
                    this.location = new URL(window.location.href);
                    const { restorationIdentifier } = turbo;
                    this.restorationIdentifier = restorationIdentifier;
                    this.delegate.historyPoppedToLocationWithRestorationIdentifier(this.location, restorationIdentifier);
                }
            }
        };
        this.onPageLoad = async (event) => {
            await nextMicrotask();
            this.pageLoaded = true;
        };
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            addEventListener("popstate", this.onPopState, false);
            addEventListener("load", this.onPageLoad, false);
            this.started = true;
            this.replace(new URL(window.location.href));
        }
    }
    stop() {
        if (this.started) {
            removeEventListener("popstate", this.onPopState, false);
            removeEventListener("load", this.onPageLoad, false);
            this.started = false;
        }
    }
    push(location, restorationIdentifier) {
        this.update(history.pushState, location, restorationIdentifier);
    }
    replace(location, restorationIdentifier) {
        this.update(history.replaceState, location, restorationIdentifier);
    }
    update(method, location, restorationIdentifier = uuid()) {
        const state = { turbo: { restorationIdentifier } };
        method.call(history, state, "", location.href);
        this.location = location;
        this.restorationIdentifier = restorationIdentifier;
    }
    getRestorationDataForIdentifier(restorationIdentifier) {
        return this.restorationData[restorationIdentifier] || {};
    }
    updateRestorationData(additionalData) {
        const { restorationIdentifier } = this;
        const restorationData = this.restorationData[restorationIdentifier];
        this.restorationData[restorationIdentifier] = Object.assign(Object.assign({}, restorationData), additionalData);
    }
    assumeControlOfScrollRestoration() {
        var _a;
        if (!this.previousScrollRestoration) {
            this.previousScrollRestoration = (_a = history.scrollRestoration) !== null && _a !== void 0 ? _a : "auto";
            history.scrollRestoration = "manual";
        }
    }
    relinquishControlOfScrollRestoration() {
        if (this.previousScrollRestoration) {
            history.scrollRestoration = this.previousScrollRestoration;
            delete this.previousScrollRestoration;
        }
    }
    shouldHandlePopState() {
        return this.pageIsLoaded();
    }
    pageIsLoaded() {
        return this.pageLoaded || document.readyState == "complete";
    }
}

class LinkClickObserver {
    constructor(delegate) {
        this.started = false;
        this.clickCaptured = () => {
            removeEventListener("click", this.clickBubbled, false);
            addEventListener("click", this.clickBubbled, false);
        };
        this.clickBubbled = (event) => {
            if (this.clickEventIsSignificant(event)) {
                const target = (event.composedPath && event.composedPath()[0]) || event.target;
                const link = this.findLinkFromClickTarget(target);
                if (link) {
                    const location = this.getLocationForLink(link);
                    if (this.delegate.willFollowLinkToLocation(link, location)) {
                        event.preventDefault();
                        this.delegate.followedLinkToLocation(link, location);
                    }
                }
            }
        };
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            addEventListener("click", this.clickCaptured, true);
            this.started = true;
        }
    }
    stop() {
        if (this.started) {
            removeEventListener("click", this.clickCaptured, true);
            this.started = false;
        }
    }
    clickEventIsSignificant(event) {
        return !((event.target && event.target.isContentEditable)
            || event.defaultPrevented
            || event.which > 1
            || event.altKey
            || event.ctrlKey
            || event.metaKey
            || event.shiftKey);
    }
    findLinkFromClickTarget(target) {
        if (target instanceof Element) {
            return target.closest("a[href]:not([target^=_]):not([download])");
        }
    }
    getLocationForLink(link) {
        return expandURL(link.getAttribute("href") || "");
    }
}

function isAction(action) {
    return action == "advance" || action == "replace" || action == "restore";
}

class Navigator {
    constructor(delegate) {
        this.delegate = delegate;
    }
    proposeVisit(location, options = {}) {
        if (this.delegate.allowsVisitingLocationWithAction(location, options.action)) {
            if (locationIsVisitable(location, this.view.snapshot.rootLocation)) {
                this.delegate.visitProposedToLocation(location, options);
            }
            else {
                window.location.href = location.toString();
            }
        }
    }
    startVisit(locatable, restorationIdentifier, options = {}) {
        this.stop();
        this.currentVisit = new Visit(this, expandURL(locatable), restorationIdentifier, Object.assign({ referrer: this.location }, options));
        this.currentVisit.start();
    }
    submitForm(form, submitter) {
        this.stop();
        this.formSubmission = new FormSubmission(this, form, submitter, true);
        this.formSubmission.start();
    }
    stop() {
        if (this.formSubmission) {
            this.formSubmission.stop();
            delete this.formSubmission;
        }
        if (this.currentVisit) {
            this.currentVisit.cancel();
            delete this.currentVisit;
        }
    }
    get adapter() {
        return this.delegate.adapter;
    }
    get view() {
        return this.delegate.view;
    }
    get history() {
        return this.delegate.history;
    }
    formSubmissionStarted(formSubmission) {
        if (typeof this.adapter.formSubmissionStarted === 'function') {
            this.adapter.formSubmissionStarted(formSubmission);
        }
    }
    async formSubmissionSucceededWithResponse(formSubmission, fetchResponse) {
        if (formSubmission == this.formSubmission) {
            const responseHTML = await fetchResponse.responseHTML;
            if (responseHTML) {
                if (formSubmission.method != FetchMethod.get) {
                    this.view.clearSnapshotCache();
                }
                const { statusCode, redirected } = fetchResponse;
                const action = this.getActionForFormSubmission(formSubmission);
                const visitOptions = { action, response: { statusCode, responseHTML, redirected } };
                this.proposeVisit(fetchResponse.location, visitOptions);
            }
        }
    }
    async formSubmissionFailedWithResponse(formSubmission, fetchResponse) {
        const responseHTML = await fetchResponse.responseHTML;
        if (responseHTML) {
            const snapshot = PageSnapshot.fromHTMLString(responseHTML);
            if (fetchResponse.serverError) {
                await this.view.renderError(snapshot);
            }
            else {
                await this.view.renderPage(snapshot);
            }
            this.view.scrollToTop();
            this.view.clearSnapshotCache();
        }
    }
    formSubmissionErrored(formSubmission, error) {
        console.error(error);
    }
    formSubmissionFinished(formSubmission) {
        if (typeof this.adapter.formSubmissionFinished === 'function') {
            this.adapter.formSubmissionFinished(formSubmission);
        }
    }
    visitStarted(visit) {
        this.delegate.visitStarted(visit);
    }
    visitCompleted(visit) {
        this.delegate.visitCompleted(visit);
    }
    locationWithActionIsSamePage(location, action) {
        const anchor = getAnchor(location);
        const currentAnchor = getAnchor(this.view.lastRenderedLocation);
        const isRestorationToTop = action === 'restore' && typeof anchor === 'undefined';
        return action !== "replace" &&
            getRequestURL(location) === getRequestURL(this.view.lastRenderedLocation) &&
            (isRestorationToTop || (anchor != null && anchor !== currentAnchor));
    }
    visitScrolledToSamePageLocation(oldURL, newURL) {
        this.delegate.visitScrolledToSamePageLocation(oldURL, newURL);
    }
    get location() {
        return this.history.location;
    }
    get restorationIdentifier() {
        return this.history.restorationIdentifier;
    }
    getActionForFormSubmission(formSubmission) {
        const { formElement, submitter } = formSubmission;
        const action = getAttribute("data-turbo-action", submitter, formElement);
        return isAction(action) ? action : "advance";
    }
}

var PageStage;
(function (PageStage) {
    PageStage[PageStage["initial"] = 0] = "initial";
    PageStage[PageStage["loading"] = 1] = "loading";
    PageStage[PageStage["interactive"] = 2] = "interactive";
    PageStage[PageStage["complete"] = 3] = "complete";
})(PageStage || (PageStage = {}));
class PageObserver {
    constructor(delegate) {
        this.stage = PageStage.initial;
        this.started = false;
        this.interpretReadyState = () => {
            const { readyState } = this;
            if (readyState == "interactive") {
                this.pageIsInteractive();
            }
            else if (readyState == "complete") {
                this.pageIsComplete();
            }
        };
        this.pageWillUnload = () => {
            this.delegate.pageWillUnload();
        };
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            if (this.stage == PageStage.initial) {
                this.stage = PageStage.loading;
            }
            document.addEventListener("readystatechange", this.interpretReadyState, false);
            addEventListener("pagehide", this.pageWillUnload, false);
            this.started = true;
        }
    }
    stop() {
        if (this.started) {
            document.removeEventListener("readystatechange", this.interpretReadyState, false);
            removeEventListener("pagehide", this.pageWillUnload, false);
            this.started = false;
        }
    }
    pageIsInteractive() {
        if (this.stage == PageStage.loading) {
            this.stage = PageStage.interactive;
            this.delegate.pageBecameInteractive();
        }
    }
    pageIsComplete() {
        this.pageIsInteractive();
        if (this.stage == PageStage.interactive) {
            this.stage = PageStage.complete;
            this.delegate.pageLoaded();
        }
    }
    get readyState() {
        return document.readyState;
    }
}

class ScrollObserver {
    constructor(delegate) {
        this.started = false;
        this.onScroll = () => {
            this.updatePosition({ x: window.pageXOffset, y: window.pageYOffset });
        };
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            addEventListener("scroll", this.onScroll, false);
            this.onScroll();
            this.started = true;
        }
    }
    stop() {
        if (this.started) {
            removeEventListener("scroll", this.onScroll, false);
            this.started = false;
        }
    }
    updatePosition(position) {
        this.delegate.scrollPositionChanged(position);
    }
}

class StreamObserver {
    constructor(delegate) {
        this.sources = new Set;
        this.started = false;
        this.inspectFetchResponse = ((event) => {
            const response = fetchResponseFromEvent(event);
            if (response && fetchResponseIsStream(response)) {
                event.preventDefault();
                this.receiveMessageResponse(response);
            }
        });
        this.receiveMessageEvent = (event) => {
            if (this.started && typeof event.data == "string") {
                this.receiveMessageHTML(event.data);
            }
        };
        this.delegate = delegate;
    }
    start() {
        if (!this.started) {
            this.started = true;
            addEventListener("turbo:before-fetch-response", this.inspectFetchResponse, false);
        }
    }
    stop() {
        if (this.started) {
            this.started = false;
            removeEventListener("turbo:before-fetch-response", this.inspectFetchResponse, false);
        }
    }
    connectStreamSource(source) {
        if (!this.streamSourceIsConnected(source)) {
            this.sources.add(source);
            source.addEventListener("message", this.receiveMessageEvent, false);
        }
    }
    disconnectStreamSource(source) {
        if (this.streamSourceIsConnected(source)) {
            this.sources.delete(source);
            source.removeEventListener("message", this.receiveMessageEvent, false);
        }
    }
    streamSourceIsConnected(source) {
        return this.sources.has(source);
    }
    async receiveMessageResponse(response) {
        const html = await response.responseHTML;
        if (html) {
            this.receiveMessageHTML(html);
        }
    }
    receiveMessageHTML(html) {
        this.delegate.receivedMessageFromStream(new StreamMessage(html));
    }
}
function fetchResponseFromEvent(event) {
    var _a;
    const fetchResponse = (_a = event.detail) === null || _a === void 0 ? void 0 : _a.fetchResponse;
    if (fetchResponse instanceof FetchResponse) {
        return fetchResponse;
    }
}
function fetchResponseIsStream(response) {
    var _a;
    const contentType = (_a = response.contentType) !== null && _a !== void 0 ? _a : "";
    return contentType.startsWith(StreamMessage.contentType);
}

class ErrorRenderer extends Renderer {
    async render() {
        this.replaceHeadAndBody();
        this.activateScriptElements();
    }
    replaceHeadAndBody() {
        const { documentElement, head, body } = document;
        documentElement.replaceChild(this.newHead, head);
        documentElement.replaceChild(this.newElement, body);
    }
    activateScriptElements() {
        for (const replaceableElement of this.scriptElements) {
            const parentNode = replaceableElement.parentNode;
            if (parentNode) {
                const element = this.createScriptElement(replaceableElement);
                parentNode.replaceChild(element, replaceableElement);
            }
        }
    }
    get newHead() {
        return this.newSnapshot.headSnapshot.element;
    }
    get scriptElements() {
        return [...document.documentElement.querySelectorAll("script")];
    }
}

class PageRenderer extends Renderer {
    get shouldRender() {
        return this.newSnapshot.isVisitable && this.trackedElementsAreIdentical;
    }
    prepareToRender() {
        this.mergeHead();
    }
    async render() {
        if (this.willRender) {
            this.replaceBody();
        }
    }
    finishRendering() {
        super.finishRendering();
        if (!this.isPreview) {
            this.focusFirstAutofocusableElement();
        }
    }
    get currentHeadSnapshot() {
        return this.currentSnapshot.headSnapshot;
    }
    get newHeadSnapshot() {
        return this.newSnapshot.headSnapshot;
    }
    get newElement() {
        return this.newSnapshot.element;
    }
    mergeHead() {
        this.copyNewHeadStylesheetElements();
        this.copyNewHeadScriptElements();
        this.removeCurrentHeadProvisionalElements();
        this.copyNewHeadProvisionalElements();
    }
    replaceBody() {
        this.preservingPermanentElements(() => {
            this.activateNewBody();
            this.assignNewBody();
        });
    }
    get trackedElementsAreIdentical() {
        return this.currentHeadSnapshot.trackedElementSignature == this.newHeadSnapshot.trackedElementSignature;
    }
    copyNewHeadStylesheetElements() {
        for (const element of this.newHeadStylesheetElements) {
            document.head.appendChild(element);
        }
    }
    copyNewHeadScriptElements() {
        for (const element of this.newHeadScriptElements) {
            document.head.appendChild(this.createScriptElement(element));
        }
    }
    removeCurrentHeadProvisionalElements() {
        for (const element of this.currentHeadProvisionalElements) {
            document.head.removeChild(element);
        }
    }
    copyNewHeadProvisionalElements() {
        for (const element of this.newHeadProvisionalElements) {
            document.head.appendChild(element);
        }
    }
    activateNewBody() {
        document.adoptNode(this.newElement);
        this.activateNewBodyScriptElements();
    }
    activateNewBodyScriptElements() {
        for (const inertScriptElement of this.newBodyScriptElements) {
            const activatedScriptElement = this.createScriptElement(inertScriptElement);
            inertScriptElement.replaceWith(activatedScriptElement);
        }
    }
    assignNewBody() {
        if (document.body && this.newElement instanceof HTMLBodyElement) {
            document.body.replaceWith(this.newElement);
        }
        else {
            document.documentElement.appendChild(this.newElement);
        }
    }
    get newHeadStylesheetElements() {
        return this.newHeadSnapshot.getStylesheetElementsNotInSnapshot(this.currentHeadSnapshot);
    }
    get newHeadScriptElements() {
        return this.newHeadSnapshot.getScriptElementsNotInSnapshot(this.currentHeadSnapshot);
    }
    get currentHeadProvisionalElements() {
        return this.currentHeadSnapshot.provisionalElements;
    }
    get newHeadProvisionalElements() {
        return this.newHeadSnapshot.provisionalElements;
    }
    get newBodyScriptElements() {
        return this.newElement.querySelectorAll("script");
    }
}

class SnapshotCache {
    constructor(size) {
        this.keys = [];
        this.snapshots = {};
        this.size = size;
    }
    has(location) {
        return toCacheKey(location) in this.snapshots;
    }
    get(location) {
        if (this.has(location)) {
            const snapshot = this.read(location);
            this.touch(location);
            return snapshot;
        }
    }
    put(location, snapshot) {
        this.write(location, snapshot);
        this.touch(location);
        return snapshot;
    }
    clear() {
        this.snapshots = {};
    }
    read(location) {
        return this.snapshots[toCacheKey(location)];
    }
    write(location, snapshot) {
        this.snapshots[toCacheKey(location)] = snapshot;
    }
    touch(location) {
        const key = toCacheKey(location);
        const index = this.keys.indexOf(key);
        if (index > -1)
            this.keys.splice(index, 1);
        this.keys.unshift(key);
        this.trim();
    }
    trim() {
        for (const key of this.keys.splice(this.size)) {
            delete this.snapshots[key];
        }
    }
}

class PageView extends View {
    constructor() {
        super(...arguments);
        this.snapshotCache = new SnapshotCache(10);
        this.lastRenderedLocation = new URL(location.href);
    }
    renderPage(snapshot, isPreview = false, willRender = true) {
        const renderer = new PageRenderer(this.snapshot, snapshot, isPreview, willRender);
        return this.render(renderer);
    }
    renderError(snapshot) {
        const renderer = new ErrorRenderer(this.snapshot, snapshot, false);
        return this.render(renderer);
    }
    clearSnapshotCache() {
        this.snapshotCache.clear();
    }
    async cacheSnapshot() {
        if (this.shouldCacheSnapshot) {
            this.delegate.viewWillCacheSnapshot();
            const { snapshot, lastRenderedLocation: location } = this;
            await nextEventLoopTick();
            const cachedSnapshot = snapshot.clone();
            this.snapshotCache.put(location, cachedSnapshot);
            return cachedSnapshot;
        }
    }
    getCachedSnapshotForLocation(location) {
        return this.snapshotCache.get(location);
    }
    get snapshot() {
        return PageSnapshot.fromElement(this.element);
    }
    get shouldCacheSnapshot() {
        return this.snapshot.isCacheable;
    }
}

class Session {
    constructor() {
        this.navigator = new Navigator(this);
        this.history = new History(this);
        this.view = new PageView(this, document.documentElement);
        this.adapter = new BrowserAdapter(this);
        this.pageObserver = new PageObserver(this);
        this.cacheObserver = new CacheObserver();
        this.linkClickObserver = new LinkClickObserver(this);
        this.formSubmitObserver = new FormSubmitObserver(this);
        this.scrollObserver = new ScrollObserver(this);
        this.streamObserver = new StreamObserver(this);
        this.frameRedirector = new FrameRedirector(document.documentElement);
        this.drive = true;
        this.enabled = true;
        this.progressBarDelay = 500;
        this.started = false;
    }
    start() {
        if (!this.started) {
            this.pageObserver.start();
            this.cacheObserver.start();
            this.linkClickObserver.start();
            this.formSubmitObserver.start();
            this.scrollObserver.start();
            this.streamObserver.start();
            this.frameRedirector.start();
            this.history.start();
            this.started = true;
            this.enabled = true;
        }
    }
    disable() {
        this.enabled = false;
    }
    stop() {
        if (this.started) {
            this.pageObserver.stop();
            this.cacheObserver.stop();
            this.linkClickObserver.stop();
            this.formSubmitObserver.stop();
            this.scrollObserver.stop();
            this.streamObserver.stop();
            this.frameRedirector.stop();
            this.history.stop();
            this.started = false;
        }
    }
    registerAdapter(adapter) {
        this.adapter = adapter;
    }
    visit(location, options = {}) {
        this.navigator.proposeVisit(expandURL(location), options);
    }
    connectStreamSource(source) {
        this.streamObserver.connectStreamSource(source);
    }
    disconnectStreamSource(source) {
        this.streamObserver.disconnectStreamSource(source);
    }
    renderStreamMessage(message) {
        document.documentElement.appendChild(StreamMessage.wrap(message).fragment);
    }
    clearCache() {
        this.view.clearSnapshotCache();
    }
    setProgressBarDelay(delay) {
        this.progressBarDelay = delay;
    }
    get location() {
        return this.history.location;
    }
    get restorationIdentifier() {
        return this.history.restorationIdentifier;
    }
    historyPoppedToLocationWithRestorationIdentifier(location, restorationIdentifier) {
        if (this.enabled) {
            this.navigator.startVisit(location, restorationIdentifier, { action: "restore", historyChanged: true });
        }
        else {
            this.adapter.pageInvalidated();
        }
    }
    scrollPositionChanged(position) {
        this.history.updateRestorationData({ scrollPosition: position });
    }
    willFollowLinkToLocation(link, location) {
        return this.elementDriveEnabled(link)
            && locationIsVisitable(location, this.snapshot.rootLocation)
            && this.applicationAllowsFollowingLinkToLocation(link, location);
    }
    followedLinkToLocation(link, location) {
        const action = this.getActionForLink(link);
        this.convertLinkWithMethodClickToFormSubmission(link) || this.visit(location.href, { action });
    }
    convertLinkWithMethodClickToFormSubmission(link) {
        const linkMethod = link.getAttribute("data-turbo-method");
        if (linkMethod) {
            const form = document.createElement("form");
            form.method = linkMethod;
            form.action = link.getAttribute("href") || "undefined";
            form.hidden = true;
            if (link.hasAttribute("data-turbo-confirm")) {
                form.setAttribute("data-turbo-confirm", link.getAttribute("data-turbo-confirm"));
            }
            const frame = this.getTargetFrameForLink(link);
            if (frame) {
                form.setAttribute("data-turbo-frame", frame);
                form.addEventListener("turbo:submit-start", () => form.remove());
            }
            else {
                form.addEventListener("submit", () => form.remove());
            }
            document.body.appendChild(form);
            return dispatch("submit", { cancelable: true, target: form });
        }
        else {
            return false;
        }
    }
    allowsVisitingLocationWithAction(location, action) {
        return this.locationWithActionIsSamePage(location, action) || this.applicationAllowsVisitingLocation(location);
    }
    visitProposedToLocation(location, options) {
        extendURLWithDeprecatedProperties(location);
        this.adapter.visitProposedToLocation(location, options);
    }
    visitStarted(visit) {
        extendURLWithDeprecatedProperties(visit.location);
        if (!visit.silent) {
            this.notifyApplicationAfterVisitingLocation(visit.location, visit.action);
        }
    }
    visitCompleted(visit) {
        this.notifyApplicationAfterPageLoad(visit.getTimingMetrics());
    }
    locationWithActionIsSamePage(location, action) {
        return this.navigator.locationWithActionIsSamePage(location, action);
    }
    visitScrolledToSamePageLocation(oldURL, newURL) {
        this.notifyApplicationAfterVisitingSamePageLocation(oldURL, newURL);
    }
    willSubmitForm(form, submitter) {
        const action = getAction(form, submitter);
        return this.elementDriveEnabled(form)
            && (!submitter || this.elementDriveEnabled(submitter))
            && locationIsVisitable(expandURL(action), this.snapshot.rootLocation);
    }
    formSubmitted(form, submitter) {
        this.navigator.submitForm(form, submitter);
    }
    pageBecameInteractive() {
        this.view.lastRenderedLocation = this.location;
        this.notifyApplicationAfterPageLoad();
    }
    pageLoaded() {
        this.history.assumeControlOfScrollRestoration();
    }
    pageWillUnload() {
        this.history.relinquishControlOfScrollRestoration();
    }
    receivedMessageFromStream(message) {
        this.renderStreamMessage(message);
    }
    viewWillCacheSnapshot() {
        var _a;
        if (!((_a = this.navigator.currentVisit) === null || _a === void 0 ? void 0 : _a.silent)) {
            this.notifyApplicationBeforeCachingSnapshot();
        }
    }
    allowsImmediateRender({ element }, resume) {
        const event = this.notifyApplicationBeforeRender(element, resume);
        return !event.defaultPrevented;
    }
    viewRenderedSnapshot(snapshot, isPreview) {
        this.view.lastRenderedLocation = this.history.location;
        this.notifyApplicationAfterRender();
    }
    viewInvalidated() {
        this.adapter.pageInvalidated();
    }
    frameLoaded(frame) {
        this.notifyApplicationAfterFrameLoad(frame);
    }
    frameRendered(fetchResponse, frame) {
        this.notifyApplicationAfterFrameRender(fetchResponse, frame);
    }
    applicationAllowsFollowingLinkToLocation(link, location) {
        const event = this.notifyApplicationAfterClickingLinkToLocation(link, location);
        return !event.defaultPrevented;
    }
    applicationAllowsVisitingLocation(location) {
        const event = this.notifyApplicationBeforeVisitingLocation(location);
        return !event.defaultPrevented;
    }
    notifyApplicationAfterClickingLinkToLocation(link, location) {
        return dispatch("turbo:click", { target: link, detail: { url: location.href }, cancelable: true });
    }
    notifyApplicationBeforeVisitingLocation(location) {
        return dispatch("turbo:before-visit", { detail: { url: location.href }, cancelable: true });
    }
    notifyApplicationAfterVisitingLocation(location, action) {
        markAsBusy(document.documentElement);
        return dispatch("turbo:visit", { detail: { url: location.href, action } });
    }
    notifyApplicationBeforeCachingSnapshot() {
        return dispatch("turbo:before-cache");
    }
    notifyApplicationBeforeRender(newBody, resume) {
        return dispatch("turbo:before-render", { detail: { newBody, resume }, cancelable: true });
    }
    notifyApplicationAfterRender() {
        return dispatch("turbo:render");
    }
    notifyApplicationAfterPageLoad(timing = {}) {
        clearBusyState(document.documentElement);
        return dispatch("turbo:load", { detail: { url: this.location.href, timing } });
    }
    notifyApplicationAfterVisitingSamePageLocation(oldURL, newURL) {
        dispatchEvent(new HashChangeEvent("hashchange", { oldURL: oldURL.toString(), newURL: newURL.toString() }));
    }
    notifyApplicationAfterFrameLoad(frame) {
        return dispatch("turbo:frame-load", { target: frame });
    }
    notifyApplicationAfterFrameRender(fetchResponse, frame) {
        return dispatch("turbo:frame-render", { detail: { fetchResponse }, target: frame, cancelable: true });
    }
    elementDriveEnabled(element) {
        const container = element === null || element === void 0 ? void 0 : element.closest("[data-turbo]");
        if (this.drive) {
            if (container) {
                return container.getAttribute("data-turbo") != "false";
            }
            else {
                return true;
            }
        }
        else {
            if (container) {
                return container.getAttribute("data-turbo") == "true";
            }
            else {
                return false;
            }
        }
    }
    getActionForLink(link) {
        const action = link.getAttribute("data-turbo-action");
        return isAction(action) ? action : "advance";
    }
    getTargetFrameForLink(link) {
        const frame = link.getAttribute("data-turbo-frame");
        if (frame) {
            return frame;
        }
        else {
            const container = link.closest("turbo-frame");
            if (container) {
                return container.id;
            }
        }
    }
    get snapshot() {
        return this.view.snapshot;
    }
}
function extendURLWithDeprecatedProperties(url) {
    Object.defineProperties(url, deprecatedLocationPropertyDescriptors);
}
const deprecatedLocationPropertyDescriptors = {
    absoluteURL: {
        get() {
            return this.toString();
        }
    }
};

const session = new Session;
const { navigator: navigator$1 } = session;
function start() {
    session.start();
}
function registerAdapter(adapter) {
    session.registerAdapter(adapter);
}
function visit(location, options) {
    session.visit(location, options);
}
function connectStreamSource(source) {
    session.connectStreamSource(source);
}
function disconnectStreamSource(source) {
    session.disconnectStreamSource(source);
}
function renderStreamMessage(message) {
    session.renderStreamMessage(message);
}
function clearCache() {
    session.clearCache();
}
function setProgressBarDelay(delay) {
    session.setProgressBarDelay(delay);
}
function setConfirmMethod(confirmMethod) {
    FormSubmission.confirmMethod = confirmMethod;
}

var Turbo = /*#__PURE__*/Object.freeze({
    __proto__: null,
    navigator: navigator$1,
    session: session,
    PageRenderer: PageRenderer,
    PageSnapshot: PageSnapshot,
    start: start,
    registerAdapter: registerAdapter,
    visit: visit,
    connectStreamSource: connectStreamSource,
    disconnectStreamSource: disconnectStreamSource,
    renderStreamMessage: renderStreamMessage,
    clearCache: clearCache,
    setProgressBarDelay: setProgressBarDelay,
    setConfirmMethod: setConfirmMethod
});

class FrameController {
    constructor(element) {
        this.fetchResponseLoaded = (fetchResponse) => { };
        this.currentFetchRequest = null;
        this.resolveVisitPromise = () => { };
        this.connected = false;
        this.hasBeenLoaded = false;
        this.settingSourceURL = false;
        this.element = element;
        this.view = new FrameView(this, this.element);
        this.appearanceObserver = new AppearanceObserver(this, this.element);
        this.linkInterceptor = new LinkInterceptor(this, this.element);
        this.formInterceptor = new FormInterceptor(this, this.element);
    }
    connect() {
        if (!this.connected) {
            this.connected = true;
            this.reloadable = false;
            if (this.loadingStyle == FrameLoadingStyle.lazy) {
                this.appearanceObserver.start();
            }
            this.linkInterceptor.start();
            this.formInterceptor.start();
            this.sourceURLChanged();
        }
    }
    disconnect() {
        if (this.connected) {
            this.connected = false;
            this.appearanceObserver.stop();
            this.linkInterceptor.stop();
            this.formInterceptor.stop();
        }
    }
    disabledChanged() {
        if (this.loadingStyle == FrameLoadingStyle.eager) {
            this.loadSourceURL();
        }
    }
    sourceURLChanged() {
        if (this.loadingStyle == FrameLoadingStyle.eager || this.hasBeenLoaded) {
            this.loadSourceURL();
        }
    }
    loadingStyleChanged() {
        if (this.loadingStyle == FrameLoadingStyle.lazy) {
            this.appearanceObserver.start();
        }
        else {
            this.appearanceObserver.stop();
            this.loadSourceURL();
        }
    }
    async loadSourceURL() {
        if (!this.settingSourceURL && this.enabled && this.isActive && (this.reloadable || this.sourceURL != this.currentURL)) {
            const previousURL = this.currentURL;
            this.currentURL = this.sourceURL;
            if (this.sourceURL) {
                try {
                    this.element.loaded = this.visit(expandURL(this.sourceURL));
                    this.appearanceObserver.stop();
                    await this.element.loaded;
                    this.hasBeenLoaded = true;
                }
                catch (error) {
                    this.currentURL = previousURL;
                    throw error;
                }
            }
        }
    }
    async loadResponse(fetchResponse) {
        if (fetchResponse.redirected || (fetchResponse.succeeded && fetchResponse.isHTML)) {
            this.sourceURL = fetchResponse.response.url;
        }
        try {
            const html = await fetchResponse.responseHTML;
            if (html) {
                const { body } = parseHTMLDocument(html);
                const snapshot = new Snapshot(await this.extractForeignFrameElement(body));
                const renderer = new FrameRenderer(this.view.snapshot, snapshot, false, false);
                if (this.view.renderPromise)
                    await this.view.renderPromise;
                await this.view.render(renderer);
                session.frameRendered(fetchResponse, this.element);
                session.frameLoaded(this.element);
                this.fetchResponseLoaded(fetchResponse);
            }
        }
        catch (error) {
            console.error(error);
            this.view.invalidate();
        }
        finally {
            this.fetchResponseLoaded = () => { };
        }
    }
    elementAppearedInViewport(element) {
        this.loadSourceURL();
    }
    shouldInterceptLinkClick(element, url) {
        if (element.hasAttribute("data-turbo-method")) {
            return false;
        }
        else {
            return this.shouldInterceptNavigation(element);
        }
    }
    linkClickIntercepted(element, url) {
        this.reloadable = true;
        this.navigateFrame(element, url);
    }
    shouldInterceptFormSubmission(element, submitter) {
        return this.shouldInterceptNavigation(element, submitter);
    }
    formSubmissionIntercepted(element, submitter) {
        if (this.formSubmission) {
            this.formSubmission.stop();
        }
        this.reloadable = false;
        this.formSubmission = new FormSubmission(this, element, submitter);
        const { fetchRequest } = this.formSubmission;
        this.prepareHeadersForRequest(fetchRequest.headers, fetchRequest);
        this.formSubmission.start();
    }
    prepareHeadersForRequest(headers, request) {
        headers["Turbo-Frame"] = this.id;
    }
    requestStarted(request) {
        markAsBusy(this.element);
    }
    requestPreventedHandlingResponse(request, response) {
        this.resolveVisitPromise();
    }
    async requestSucceededWithResponse(request, response) {
        await this.loadResponse(response);
        this.resolveVisitPromise();
    }
    requestFailedWithResponse(request, response) {
        console.error(response);
        this.resolveVisitPromise();
    }
    requestErrored(request, error) {
        console.error(error);
        this.resolveVisitPromise();
    }
    requestFinished(request) {
        clearBusyState(this.element);
    }
    formSubmissionStarted({ formElement }) {
        markAsBusy(formElement, this.findFrameElement(formElement));
    }
    formSubmissionSucceededWithResponse(formSubmission, response) {
        const frame = this.findFrameElement(formSubmission.formElement, formSubmission.submitter);
        this.proposeVisitIfNavigatedWithAction(frame, formSubmission.formElement, formSubmission.submitter);
        frame.delegate.loadResponse(response);
    }
    formSubmissionFailedWithResponse(formSubmission, fetchResponse) {
        this.element.delegate.loadResponse(fetchResponse);
    }
    formSubmissionErrored(formSubmission, error) {
        console.error(error);
    }
    formSubmissionFinished({ formElement }) {
        clearBusyState(formElement, this.findFrameElement(formElement));
    }
    allowsImmediateRender(snapshot, resume) {
        return true;
    }
    viewRenderedSnapshot(snapshot, isPreview) {
    }
    viewInvalidated() {
    }
    async visit(url) {
        var _a;
        const request = new FetchRequest(this, FetchMethod.get, url, new URLSearchParams, this.element);
        (_a = this.currentFetchRequest) === null || _a === void 0 ? void 0 : _a.cancel();
        this.currentFetchRequest = request;
        return new Promise(resolve => {
            this.resolveVisitPromise = () => {
                this.resolveVisitPromise = () => { };
                this.currentFetchRequest = null;
                resolve();
            };
            request.perform();
        });
    }
    navigateFrame(element, url, submitter) {
        const frame = this.findFrameElement(element, submitter);
        this.proposeVisitIfNavigatedWithAction(frame, element, submitter);
        frame.setAttribute("reloadable", "");
        frame.src = url;
    }
    proposeVisitIfNavigatedWithAction(frame, element, submitter) {
        const action = getAttribute("data-turbo-action", submitter, element, frame);
        if (isAction(action)) {
            const { visitCachedSnapshot } = new SnapshotSubstitution(frame);
            frame.delegate.fetchResponseLoaded = (fetchResponse) => {
                if (frame.src) {
                    const { statusCode, redirected } = fetchResponse;
                    const responseHTML = frame.ownerDocument.documentElement.outerHTML;
                    const response = { statusCode, redirected, responseHTML };
                    session.visit(frame.src, { action, response, visitCachedSnapshot, willRender: false });
                }
            };
        }
    }
    findFrameElement(element, submitter) {
        var _a;
        const id = getAttribute("data-turbo-frame", submitter, element) || this.element.getAttribute("target");
        return (_a = getFrameElementById(id)) !== null && _a !== void 0 ? _a : this.element;
    }
    async extractForeignFrameElement(container) {
        let element;
        const id = CSS.escape(this.id);
        try {
            if (element = activateElement(container.querySelector(`turbo-frame#${id}`), this.currentURL)) {
                return element;
            }
            if (element = activateElement(container.querySelector(`turbo-frame[src][recurse~=${id}]`), this.currentURL)) {
                await element.loaded;
                return await this.extractForeignFrameElement(element);
            }
            console.error(`Response has no matching <turbo-frame id="${id}"> element`);
        }
        catch (error) {
            console.error(error);
        }
        return new FrameElement();
    }
    formActionIsVisitable(form, submitter) {
        const action = getAction(form, submitter);
        return locationIsVisitable(expandURL(action), this.rootLocation);
    }
    shouldInterceptNavigation(element, submitter) {
        const id = getAttribute("data-turbo-frame", submitter, element) || this.element.getAttribute("target");
        if (element instanceof HTMLFormElement && !this.formActionIsVisitable(element, submitter)) {
            return false;
        }
        if (!this.enabled || id == "_top") {
            return false;
        }
        if (id) {
            const frameElement = getFrameElementById(id);
            if (frameElement) {
                return !frameElement.disabled;
            }
        }
        if (!session.elementDriveEnabled(element)) {
            return false;
        }
        if (submitter && !session.elementDriveEnabled(submitter)) {
            return false;
        }
        return true;
    }
    get id() {
        return this.element.id;
    }
    get enabled() {
        return !this.element.disabled;
    }
    get sourceURL() {
        if (this.element.src) {
            return this.element.src;
        }
    }
    get reloadable() {
        const frame = this.findFrameElement(this.element);
        return frame.hasAttribute("reloadable");
    }
    set reloadable(value) {
        const frame = this.findFrameElement(this.element);
        if (value) {
            frame.setAttribute("reloadable", "");
        }
        else {
            frame.removeAttribute("reloadable");
        }
    }
    set sourceURL(sourceURL) {
        this.settingSourceURL = true;
        this.element.src = sourceURL !== null && sourceURL !== void 0 ? sourceURL : null;
        this.currentURL = this.element.src;
        this.settingSourceURL = false;
    }
    get loadingStyle() {
        return this.element.loading;
    }
    get isLoading() {
        return this.formSubmission !== undefined || this.resolveVisitPromise() !== undefined;
    }
    get isActive() {
        return this.element.isActive && this.connected;
    }
    get rootLocation() {
        var _a;
        const meta = this.element.ownerDocument.querySelector(`meta[name="turbo-root"]`);
        const root = (_a = meta === null || meta === void 0 ? void 0 : meta.content) !== null && _a !== void 0 ? _a : "/";
        return expandURL(root);
    }
}
class SnapshotSubstitution {
    constructor(element) {
        this.visitCachedSnapshot = ({ element }) => {
            var _a;
            const { id, clone } = this;
            (_a = element.querySelector("#" + id)) === null || _a === void 0 ? void 0 : _a.replaceWith(clone);
        };
        this.clone = element.cloneNode(true);
        this.id = element.id;
    }
}
function getFrameElementById(id) {
    if (id != null) {
        const element = document.getElementById(id);
        if (element instanceof FrameElement) {
            return element;
        }
    }
}
function activateElement(element, currentURL) {
    if (element) {
        const src = element.getAttribute("src");
        if (src != null && currentURL != null && urlsAreEqual(src, currentURL)) {
            throw new Error(`Matching <turbo-frame id="${element.id}"> element has a source URL which references itself`);
        }
        if (element.ownerDocument !== document) {
            element = document.importNode(element, true);
        }
        if (element instanceof FrameElement) {
            element.connectedCallback();
            element.disconnectedCallback();
            return element;
        }
    }
}

const StreamActions = {
    after() {
        this.targetElements.forEach(e => { var _a; return (_a = e.parentElement) === null || _a === void 0 ? void 0 : _a.insertBefore(this.templateContent, e.nextSibling); });
    },
    append() {
        this.removeDuplicateTargetChildren();
        this.targetElements.forEach(e => e.append(this.templateContent));
    },
    before() {
        this.targetElements.forEach(e => { var _a; return (_a = e.parentElement) === null || _a === void 0 ? void 0 : _a.insertBefore(this.templateContent, e); });
    },
    prepend() {
        this.removeDuplicateTargetChildren();
        this.targetElements.forEach(e => e.prepend(this.templateContent));
    },
    remove() {
        this.targetElements.forEach(e => e.remove());
    },
    replace() {
        this.targetElements.forEach(e => e.replaceWith(this.templateContent));
    },
    update() {
        this.targetElements.forEach(e => {
            e.innerHTML = "";
            e.append(this.templateContent);
        });
    }
};

class StreamElement extends HTMLElement {
    async connectedCallback() {
        try {
            await this.render();
        }
        catch (error) {
            console.error(error);
        }
        finally {
            this.disconnect();
        }
    }
    async render() {
        var _a;
        return (_a = this.renderPromise) !== null && _a !== void 0 ? _a : (this.renderPromise = (async () => {
            if (this.dispatchEvent(this.beforeRenderEvent)) {
                await nextAnimationFrame();
                this.performAction();
            }
        })());
    }
    disconnect() {
        try {
            this.remove();
        }
        catch (_a) { }
    }
    removeDuplicateTargetChildren() {
        this.duplicateChildren.forEach(c => c.remove());
    }
    get duplicateChildren() {
        var _a;
        const existingChildren = this.targetElements.flatMap(e => [...e.children]).filter(c => !!c.id);
        const newChildrenIds = [...(_a = this.templateContent) === null || _a === void 0 ? void 0 : _a.children].filter(c => !!c.id).map(c => c.id);
        return existingChildren.filter(c => newChildrenIds.includes(c.id));
    }
    get performAction() {
        if (this.action) {
            const actionFunction = StreamActions[this.action];
            if (actionFunction) {
                return actionFunction;
            }
            this.raise("unknown action");
        }
        this.raise("action attribute is missing");
    }
    get targetElements() {
        if (this.target) {
            return this.targetElementsById;
        }
        else if (this.targets) {
            return this.targetElementsByQuery;
        }
        else {
            this.raise("target or targets attribute is missing");
        }
    }
    get templateContent() {
        return this.templateElement.content.cloneNode(true);
    }
    get templateElement() {
        if (this.firstElementChild instanceof HTMLTemplateElement) {
            return this.firstElementChild;
        }
        this.raise("first child element must be a <template> element");
    }
    get action() {
        return this.getAttribute("action");
    }
    get target() {
        return this.getAttribute("target");
    }
    get targets() {
        return this.getAttribute("targets");
    }
    raise(message) {
        throw new Error(`${this.description}: ${message}`);
    }
    get description() {
        var _a, _b;
        return (_b = ((_a = this.outerHTML.match(/<[^>]+>/)) !== null && _a !== void 0 ? _a : [])[0]) !== null && _b !== void 0 ? _b : "<turbo-stream>";
    }
    get beforeRenderEvent() {
        return new CustomEvent("turbo:before-stream-render", { bubbles: true, cancelable: true });
    }
    get targetElementsById() {
        var _a;
        const element = (_a = this.ownerDocument) === null || _a === void 0 ? void 0 : _a.getElementById(this.target);
        if (element !== null) {
            return [element];
        }
        else {
            return [];
        }
    }
    get targetElementsByQuery() {
        var _a;
        const elements = (_a = this.ownerDocument) === null || _a === void 0 ? void 0 : _a.querySelectorAll(this.targets);
        if (elements.length !== 0) {
            return Array.prototype.slice.call(elements);
        }
        else {
            return [];
        }
    }
}

FrameElement.delegateConstructor = FrameController;
customElements.define("turbo-frame", FrameElement);
customElements.define("turbo-stream", StreamElement);

(() => {
    let element = document.currentScript;
    if (!element)
        return;
    if (element.hasAttribute("data-turbo-suppress-warning"))
        return;
    while (element = element.parentElement) {
        if (element == document.body) {
            return console.warn(unindent `
        You are loading Turbo from a <script> element inside the <body> element. This is probably not what you meant to do!

        Load your application’s JavaScript bundle inside the <head> element instead. <script> elements in <body> are evaluated with each page change.

        For more information, see: https://turbo.hotwired.dev/handbook/building#working-with-script-elements

        ——
        Suppress this warning by adding a "data-turbo-suppress-warning" attribute to: %s
      `, element.outerHTML);
        }
    }
})();

window.Turbo = Turbo;
start();




/***/ }),

/***/ "./resources/assets/js/admin_withdraw/withdraw.js":
/*!********************************************************!*\
  !*** ./resources/assets/js/admin_withdraw/withdraw.js ***!
  \********************************************************/
/***/ (() => {

"use strict";


listen('click', '.admin-withdraw-request-btn', function (event) {
  var id = $(event.currentTarget).data('id');
  $('.swal-content__textarea').attr('placeholder', 'Type your notes here');
  var divAttr = document.createElement("div");
  divAttr.innerHTML = '<textarea class="swal2-textarea swal-content__input mt-3" id="notes" placeholder="Type your message here" style="display: flex;"></textarea>';
  swal({
    title: 'Withdraw Request',
    content: divAttr,
    inputPlaceholder: 'Type your notes here',
    text: 'Are you sure ?',
    type: 'info',
    icon: sweetWithdrawAlertIcon,
    buttons: {
      confirm: 'Approve!',
      denyButtonText: 'Reject',
      cancel: 'Cancel'
    }
  }).then(function (result) {
    if (!result) return null;
    var notes = $('.swal-content__input').val();

    if (result == true) {
      $.ajax({
        url: route('withdraw.update', id),
        type: 'PUT',
        data: {
          admin_notes: notes,
          is_approved: 1
        },
        success: function success(obj) {
          var email = obj.data.email;
          var reference_id = obj.data.id;
          var amount = obj.data.deducate_amount;
          var currency = obj.data.campaign.currency;
          $.ajax({
            type: 'GET',
            url: route('paypal.payout'),
            data: {
              reference_id: reference_id,
              email: email,
              amount: amount,
              currency: currency
            },
            success: function success(result) {
              if (result.url) {
                window.location.href = result.url;
              }

              if (result.statusCode === 201) {
                var redirectTo = '';
                $.each(result.result.links, function (key, val) {
                  if (val.rel == 'approve') {
                    redirectTo = val.href;
                  }
                });
                location.href = redirectTo;
              }
            },
            error: function error(_error) {},
            complete: function complete() {}
          });

          if (obj.success) {
            window.livewire.emit('refresh');
          }

          swal({
            title: 'Approved',
            text: 'Withdraw request has Approved.',
            icon: 'success',
            timer: 2000,
            confirmButtonColor: '#009ef7'
          });
        },
        error: function error(data) {
          swal({
            title: 'Error',
            icon: 'error',
            text: data.responseJSON.message,
            type: 'error',
            timer: 5000,
            confirmButtonColor: '#009ef7'
          });
        }
      });
    } else {
      var _notes = $('.swal-content__input').val();

      $.ajax({
        url: route('withdraw.update', id),
        type: 'PUT',
        data: {
          admin_notes: _notes,
          status: 3
        },
        success: function success(result) {
          if (result.success) {
            swal({
              title: 'Rejected',
              text: result.message,
              icon: 'success',
              timer: 2000,
              confirmButtonColor: '#009ef7'
            });
            window.livewire.emit('refresh');
          }
        },
        error: function error(data) {
          swal({
            title: 'Error',
            icon: 'error',
            text: data.responseJSON.message,
            type: 'error',
            timer: 5000,
            confirmButtonColor: '#009ef7'
          });
        }
      });
    }
  });
});
listen('change', '#withdrawStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'));
});
listen('click', '#withdrawResetFilter', function () {
  $('#withdrawStatus').val(5).change();
  hideDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'));
});
listen('click', '#withdrawStatusFilterBtn', function () {
  openDropdownManually($('#withdrawStatusFilterBtn'), $('#withdrawFilter'));
});
listen('click', '.withdraw-request-show-btn', function (event) {
  var withdrawId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('withdraw.showPaymentDetails', withdrawId),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        var data = result.data;

        if (data.payment_type == 1) {
          $('#showPaypalAccountEmail').html(data.email);
          $('#showPaypalAccountMessage').html(!isEmpty(data.user_notes) ? data.user_notes : 'N/A');
          $('#showPaypalCreatedRequestDate').text(moment(data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
          $('#approvedPayPalType').html(data.approved_type);
          $('#paypalPaymentDetailsShowModel').appendTo('body').modal('show');
        } else {
          $('#showBankAccountNumber').html(data.bank_details.account_number);
          $('#showIsbnNo').html(data.bank_details.isbn_number);
          $('#showBranchName').html(data.bank_details.branch_name);
          $('#showAccountHolderName').html(data.bank_details.account_holder_name);
          $('#showBankMessage').html(!isEmpty(data.user_notes) ? data.user_notes : 'N/A');
          $('#showBankCreatedRequestDate').text(moment(data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
          $('#approvedType').html(data.approved_type);
          $('#bankPaymentDetailsShowModel').appendTo('body').modal('show');
        }
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/brand/brand.js":
/*!********************************************!*\
  !*** ./resources/assets/js/brand/brand.js ***!
  \********************************************/
/***/ (() => {

"use strict";


listen('submit', '#addBrandForm', function (e) {
  e.preventDefault();
  processingBtn('#addBrandForm', '#brandBtn', 'loading');
  $('#brandBtn').prop('disabled', true);
  $.ajax({
    url: route('brands.store'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#addBrandModal').modal('hide');
      $('#brandBtn').prop('disabled', false);
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#brandBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#addBrandForm', '#btnSave');
    }
  });
});
listen('submit', '#editBrandForm', function (event) {
  event.preventDefault();
  processingBtn('#editBrandForm', '#btnEditSave', 'loading');
  $('#btnEditSave').prop('disabled', true);
  var editBrandFormID = $('#editBrandId').val();
  $.ajax({
    url: route('brands.update', editBrandFormID),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editBrandModal').modal('hide');
        $('#btnEditSave').prop('disabled', false);
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#btnEditSave').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editBrandForm', '#btnEditSave');
    }
  });
});
listen('click', '.brand-delete-btn', function (event) {
  var deleteBrandID = $(event.currentTarget).data('id');
  var url = route('brands.destroy', {
    brand: deleteBrandID
  });
  deleteItem(url, 'Brand');
});
listen('click', '#addBrandBtn', function () {
  $('#addBrandModal').appendTo('body').modal('show');
  resetModalForm('#addBrandForm');
  $('#previewImage').css('background-image', 'url("' + brandDefaultImage + '")');
});
listen('click', '.brand-edit-btn', function (event) {
  var editBrandID = $(event.currentTarget).data('id');
  renderBrandsData(editBrandID);
});

function renderBrandsData(id) {
  $.ajax({
    url: route('brands.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#editBrandId').val(result.data.id);
        $('#editName').val(result.data.name);

        if (isEmpty(result.data.image_url)) {
          $('#editPreviewImage').css('background-image', 'url("' + brandDefaultImage + '")');
        } else {
          $('#editPreviewImage').css('background-image', 'url("' + result.data.image_url + '")');
        }

        $('#editBrandModal').modal('show').appendTo('body');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

/***/ }),

/***/ "./resources/assets/js/call_to_actions/call_to_actions.js":
/*!****************************************************************!*\
  !*** ./resources/assets/js/call_to_actions/call_to_actions.js ***!
  \****************************************************************/
/***/ (() => {

"use strict";


listen('click', '.call-to-action-delete-btn', function (event) {
  var deleteCallToActionID = $(event.currentTarget).data('id');
  var url = route('call-to-action.destroy', {
    callToAction: deleteCallToActionID
  });
  deleteItem(url, 'Call To Action');
});
listen('click', '.call-to-action-show-btn', function (event) {
  $('#showCallToActionModal').appendTo('body').modal('show');
  var callToActionId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('call-to-actions.index') + '/' + callToActionId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').html(result.data.name);
        $('#showPhoneNo').html(result.data.phone);
        $('#showAddress').html(result.data.address);
        $('#showZip').html(result.data.zip);
        $('#showCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#showUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#callToActionTable').DataTable().ajax.reload(null, true);
        $('#showCallToActionModal').appendTo('body').modal('show');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('change', '#callToActionStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'));
});
listen('click', '#callToActionResetFilter', function () {
  $('#callToActionStatus').val(2).change();
  hideDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'));
});
listen('click', '#callToActionFilterBtn', function () {
  openDropdownManually($('#callToActionFilterBtn'), $('#callToActionFilter'));
});

/***/ }),

/***/ "./resources/assets/js/campaign-category/campaign-category.js":
/*!********************************************************************!*\
  !*** ./resources/assets/js/campaign-category/campaign-category.js ***!
  \********************************************************************/
/***/ (() => {

"use strict";


listen('click', '#addCampaignCategoryBtn', function () {
  $('#addCampaignCategoryModal').appendTo('body').modal('show');
  resetModalForm('#addCampaignCategoryForm');
});
listen('hidden.bs.modal', '#addCampaignCategoryBtn', function () {
  resetModalForm('#addCampaignCategoryForm');
});
listen('submit', '#addCampaignCategoryForm', function (e) {
  e.preventDefault();
  processingBtn('#addCampaignCategoryForm', '#campaignCategoryBtn', 'loading');
  $('#campaignCategoryBtn').prop('disabled', true);
  $.ajax({
    url: route('campaign-categories.store'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      displaySuccessMessage(result.message);
      $('#addCampaignCategoryModal').modal('hide');
      $('#campaignCategoryBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#campaignCategoryBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#addCampaignCategoryForm', '#btnSave');
    }
  });
});
listen('submit', '#editCampaignCategoryForm', function (event) {
  event.preventDefault();
  processingBtn('#editCampaignCategoryForm', '#btnEditSave', 'loading');
  $('#btnEditSave').prop('disabled', true);
  var id = $('#editCampaignCategoryId').val();
  $.ajax({
    url: route('campaign-categories.update', id),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#btnEditSave').prop('disabled', false);
        displaySuccessMessage(result.message);
        $('#editCampaignCategoryModal').modal('hide');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#btnEditSave').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editCampaignCategoryForm', '#btnEditSave');
    }
  });
});
listen('click', '.campaign-category-delete-btn', function (event) {
  var deleteCampaignCategoryId = $(event.currentTarget).data('id');
  deleteItem(route('campaign-categories.destroy', deleteCampaignCategoryId), 'Campaign Category');
});
listen('click', '#addCampaignCategoryBtn', function () {
  $('#addCampaignCategoryModal').appendTo('body').modal('show');
  resetModalForm('#addCampaignCategoryForm');
});
listen('click', '.campaign-category-edit-btn', function (event) {
  var editCampaignCategoryId = $(event.currentTarget).data('id');
  renderCampaignCategoryData(editCampaignCategoryId);
});

function renderCampaignCategoryData(id) {
  $.ajax({
    url: route('campaign-categories.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#editCampaignCategoryId').val(result.data.id);
        $('#editName').val(result.data.name);
        result.data.is_active == 1 ? $('#editIsActive').prop('checked', true) : $('#editIsActive').prop('checked', false);
        $('#editIsActive').prop('disabled', false);

        if (result.data.campaigns.length > 0) {
          $('#editIsActive').prop('disabled', true);
        }

        if (isEmpty(result.data.image)) {
          $('#editCampaignCategoryPreviewImage').css('background-image', 'url("' + brandDefaultImage + '")');
        } else {
          $('#editCampaignCategoryPreviewImage').css('background-image', 'url("' + result.data.image + '")');
        }

        $('#editCampaignCategoryModal').modal('show').appendTo('body');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listen('click', '.campaign-category-active', function (event) {
  var campaignCategoryId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'post',
    url: route('campaign-categories.status'),
    data: {
      id: campaignCategoryId
    },
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      displaySuccessMessage(result.message);
    }
  });
});
listen('change', '#campaignCategoryStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'));
});
listen('click', '#campaignCategoryResetFilter', function () {
  $('#campaignCategoryStatus').val(2).change();
  hideDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'));
});
listen('click', '#campaignCategoryFilterBtn', function () {
  openDropdownManually($('#campaignCategoryFilterBtn'), $('#campaignCategoryFilter'));
});

/***/ }),

/***/ "./resources/assets/js/campaign_faqs/campaign_faqs.js":
/*!************************************************************!*\
  !*** ./resources/assets/js/campaign_faqs/campaign_faqs.js ***!
  \************************************************************/
/***/ (() => {

"use strict";


listen('click', '#addCampaignFaqs', function () {
  $('#creatCampaignFaqsModal').appendTo('body').modal('show');
  resetModalForm('#createCampaignFaqsForm');
});
listen('hidden.bs.modal', '#editCampaignFaqsModal', function () {
  resetModalForm('#editCampaignFaqsForm');
});
listen('click', '.campaign-faq-edit-btn', function (event) {
  var editCampaignFaqsId = $(event.currentTarget).data('id');
  renderCampaignFaqsData(editCampaignFaqsId);
});

function renderCampaignFaqsData(id) {
  $.ajax({
    url: route('campaign-faqs.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#campaignFaqsID').val(result.data.id);
      $('#editCampaignFaqsTitle').val(result.data.title);
      $('#editCampaignFaqsDescription').val(result.data.description);
      $('#editCampaignFaqsModal').modal('show');
    }
  });
}

listen('submit', '#createCampaignFaqsForm', function (e) {
  e.preventDefault();
  $('#createCampaignFaqsBtn').prop('disabled', true);
  $.ajax({
    url: route('campaign-faqs.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        displaySuccessMessage(result.message);
        $('#creatCampaignFaqsModal').modal('hide');
        $('#createCampaignFaqsBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createCampaignFaqsBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editCampaignFaqsForm', function (e) {
  e.preventDefault();
  $('#editCampaignFaqsBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#campaignFaqsID').val();
  $.ajax({
    url: route('campaign-faqs.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editCampaignFaqsModal').modal('hide');
      Livewire.emit('refresh', 'refresh');
      displaySuccessMessage(result.message);
      $('#editCampaignFaqsBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editCampaignFaqsBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.campaign_faq-show-btn', function (event) {
  $('#showCampaignFaqModal').appendTo('body').modal('show');
  var campaignFaqId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('campaign-faqs.index') + '/' + campaignFaqId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showTitle').html(result.data.title);
        $('#showCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#showUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#showDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showCampaignFaqModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.campaign-faq-delete-btn', function (event) {
  var deleteFaqsId = $(event.currentTarget).data('id');
  deleteItem(route('campaign-faqs.destroy', deleteFaqsId), 'Campaign FAQ');
});
listen('submit', '#createUserCampaignFaqsForm', function (e) {
  e.preventDefault();
  $('#createCampaignFaqsBtn').prop('disabled', true);
  $.ajax({
    url: route('user.campaign-faqs.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        displaySuccessMessage(result.message);
        $('#creatCampaignFaqsModal').modal('hide');
        $('#createCampaignFaqsBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createCampaignFaqsBtn').prop('disabled', false);
    }
  });
});
listen('click', '#addUserCampaignFaqs', function () {
  $('#creatCampaignFaqsModal').appendTo('body').modal('show');
  resetModalForm('#createUserCampaignFaqsForm');
});
listen('click', '.user-campaign-faq-edit-btn', function (event) {
  var editCampaignFaqsId = $(event.currentTarget).data('id');
  renderUserCampaignFaqsData(editCampaignFaqsId);
});

function renderUserCampaignFaqsData(id) {
  $.ajax({
    url: route('user.campaign-faqs.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#campaignFaqsID').val(result.data.id);
      $('#editCampaignFaqsTitle').val(result.data.title);
      $('#editCampaignFaqsDescription').val(result.data.description);
      $('#editUserCampaignFaqsModal').modal('show');
    }
  });
}

listen('hidden.bs.modal', '#editUserCampaignFaqsModal', function () {
  resetModalForm('#editUserCampaignFaqsForm');
});
listen('submit', '#editUserCampaignFaqsForm', function (e) {
  e.preventDefault();
  $('#editCampaignFaqsBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#campaignFaqsID').val();
  $.ajax({
    url: route('user.campaign-faqs.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editUserCampaignFaqsModal').modal('hide');
      Livewire.emit('refresh', 'refresh');
      displaySuccessMessage(result.message);
      $('#editCampaignFaqsBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editCampaignFaqsBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.user_campaign_faq-show-btn', function (event) {
  $('#showCampaignFaqModal').appendTo('body').modal('show');
  var campaignFaqId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.campaign-faqs.index') + '/' + campaignFaqId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showTitle').html(result.data.title);
        $('#showCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#showUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#showDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showCampaignFaqModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.user-campaign-faq-delete-btn', function (event) {
  var deleteFaqsId = $(event.currentTarget).data('id');
  deleteItem(route('user.campaign-faqs.destroy', deleteFaqsId), 'Campaign FAQ');
});

/***/ }),

/***/ "./resources/assets/js/campaign_updates/campaign_updates.js":
/*!******************************************************************!*\
  !*** ./resources/assets/js/campaign_updates/campaign_updates.js ***!
  \******************************************************************/
/***/ (() => {

"use strict";


listen('click', '#addCampaignUpdates', function () {
  $('#creatCampaignUpdatesModal').appendTo('body').modal('show');
  resetModalForm('#createCampaignUpdatesForm');
});
listen('hidden.bs.modal', '#editCampaignUpdatesModal', function () {
  resetModalForm('#editCampaignUpdatesForm');
});
listen('click', '.campaign-update-edit-btn', function (event) {
  var editCampaignUpdatesId = $(event.currentTarget).data('id');
  renderCampaignUpdatesData(editCampaignUpdatesId);
});

function renderCampaignUpdatesData(id) {
  $.ajax({
    url: route('campaign-updates.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#campaignUpdatesID').val(result.data.id);
      $('#editCampaignUpdatesTitle').val(result.data.title);
      $('#editCampaignUpdatesDescription').val(result.data.description);
      $('#editCampaignUpdatesModal').modal('show');
    }
  });
}

listen('submit', '#createCampaignUpdatesForm', function (e) {
  e.preventDefault();
  $('#createCampaignUpdateBtn').prop('disabled', true);
  $.ajax({
    url: route('campaign-updates.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        displaySuccessMessage(result.message);
        $('#creatCampaignUpdatesModal').modal('hide');
        $('#createCampaignUpdateBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createCampaignUpdateBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editCampaignUpdatesForm', function (e) {
  e.preventDefault();
  $('#editCampaignUpdateBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#campaignUpdatesID').val();
  $.ajax({
    url: route('campaign-updates.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      $('#editCampaignUpdatesModal').modal('hide');
      displaySuccessMessage(result.message);
      $('#editCampaignUpdateBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editCampaignUpdateBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.campaign_update-show-btn', function (event) {
  $('#showCampaignUpdateModal').appendTo('body').modal('show');
  var campaignFaqUpdate = $(event.currentTarget).data('id');
  $.ajax({
    url: route('campaign-updates.index') + '/' + campaignFaqUpdate,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#faqUpdateShowTitle').html(result.data.title);
        $('#faqUpdateShowCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#faqUpdateShowUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#faqUpdateShowDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showCampaignUpdateModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.campaign-update-delete-btn', function (event) {
  var deleteFaqsId = $(event.currentTarget).data('id');
  deleteItem(route('campaign-updates.destroy', deleteFaqsId), 'Campaign Updates');
});
listen('click', '#addUserCampaignUpdates', function () {
  $('#creatCampaignUpdatesModal').appendTo('body').modal('show');
  resetModalForm('#createUserCampaignUpdatesForm');
});
listen('hidden.bs.modal', '#editUserCampaignUpdatesModal', function () {
  resetModalForm('#editUserCampaignUpdatesForm');
});
listen('click', '.user-campaign-update-edit-btn', function (event) {
  var editCampaignUpdatesId = $(event.currentTarget).data('id');
  renderUserCampaignUpdatesData(editCampaignUpdatesId);
});

function renderUserCampaignUpdatesData(id) {
  $.ajax({
    url: route('user.campaign-updates.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#campaignUpdatesID').val(result.data.id);
      $('#editUserCampaignUpdatesTitle').val(result.data.title);
      $('#editUserCampaignUpdatesDescription  ').val(result.data.description);
      $('#editUserCampaignUpdatesModal').modal('show');
    }
  });
}

listen('submit', '#createUserCampaignUpdatesForm', function (e) {
  e.preventDefault();
  $('#createCampaignUpdateBtn').prop('disabled', true);
  $.ajax({
    url: route('user.campaign-updates.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        displaySuccessMessage(result.message);
        $('#creatCampaignUpdatesModal').modal('hide');
        $('#createCampaignUpdateBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createCampaignUpdateBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editUserCampaignUpdatesForm', function (e) {
  e.preventDefault();
  $('#editCampaignUpdateBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#campaignUpdatesID').val();
  $.ajax({
    url: route('user.campaign-updates.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      $('#editUserCampaignUpdatesModal').modal('hide');
      displaySuccessMessage(result.message);
      $('#editCampaignUpdateBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editCampaignUpdateBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.user-campaign-update-show-btn', function (event) {
  $('#showCampaignUpdateModal').appendTo('body').modal('show');
  var campaignFaqUpdate = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.campaign-updates.index') + '/' + campaignFaqUpdate,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#faqUpdateShowTitle').html(result.data.title);
        $('#faqUpdateShowCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#faqUpdateShowUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#faqUpdateShowDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showCampaignUpdateModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.user-campaign-update-delete-btn', function (event) {
  var deleteFaqsId = $(event.currentTarget).data('id');
  deleteItem(route('user.campaign-updates.destroy', deleteFaqsId), 'Campaign Updates');
});

/***/ }),

/***/ "./resources/assets/js/campaigns/campaigns.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/campaigns/campaigns.js ***!
  \****************************************************/
/***/ (() => {

"use strict";


listen('click', '.campaign-delete-btn', function (event) {
  var deleteCampaigntId = $(event.currentTarget).data('id');
  deleteItem(route('campaigns.destroy', deleteCampaigntId), 'Campaign');
});
listen('change', '#campaignStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'));
});
listen('click', '#campaignResetFilter', function () {
  $('#campaignStatus').val(5).change();
  hideDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'));
});
listen('click', '#campaignStatusFilterBtn', function () {
  openDropdownManually($('#campaignStatusFilterBtn'), $('#campaignFilter'));
});
listen('click', '.transaction-show-btn', function (event) {
  $('#showTransactionModal').appendTo('body').modal('show');
  var transactionId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('transaction.show') + '/' + transactionId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#userFullName').html(result.data.full_name);
        $('#showPaymentId').html(result.data.campaign_donation_transaction.transaction_id);
        $('#userEmail').html(!isEmpty(result.data.email) ? result.data.email : 'N/A');
        var campaignCurrencySymbol = $('#campaignCurrencySymbol').val();
        var amount = campaignCurrencySymbol + ' ' + addCommas(result.data.donated_amount.toFixed(2).toString());
        $('#showDonatedAmount').html(amount);
        $('#showPaymentMethod').html(result.data.campaign_donation_transaction.payment_type);
        $('#showPaymentDate').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        Livewire.emit('refresh');
        $('#showTransactionModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.transaction-show-gift-btn', function (event) {
  $('#showGiftTransactionModal').appendTo('body').modal('show');
  var transactionId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('transaction.show') + '/' + transactionId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#userGiftFullName').html(result.data.full_name);
        $('#showGiftPaymentId').html(result.data.campaign_donation_transaction.transaction_id);
        $('#userGiftEmail').html(!isEmpty(result.data.email) ? result.data.email : 'N/A');
        var campaignCurrencySymbol = $('#campaignGiftCurrencySymbol').val();
        var amount = campaignCurrencySymbol + ' ' + addCommas(result.data.donated_amount.toFixed(2).toString());
        $('#showGiftDonatedAmount').html(amount);
        $('#showGiftPaymentMethod').html(result.data.campaign_donation_transaction.payment_type);
        $('#showGiftPaymentDate').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        Livewire.emit('refresh');
        $('#showGiftTransactionModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.user-transaction-show-btn', function (event) {
  $('#showTransactionModal').appendTo('body').modal('show');
  var transactionId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.transaction.show') + '/' + transactionId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#userFullName').html(result.data.full_name);
        $('#showPaymentId').html(result.data.campaign_donation_transaction.transaction_id);
        $('#userEmail').html(!isEmpty(result.data.email) ? result.data.email : 'N/A');
        var campaignCurrencySymbol = $('#campaignCurrencySymbol').val();
        var amount = campaignCurrencySymbol + ' ' + addCommas(result.data.donated_amount.toFixed(2).toString());
        $('#showDonatedAmount').html(amount);
        $('#showPaymentMethod').html(result.data.campaign_donation_transaction.payment_type);
        $('#showPaymentDate').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        Livewire.emit('refresh');
        $('#showTransactionModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.user-campaign-delete-btn', function (event) {
  var deleteCampaigntId = $(event.currentTarget).data('id');
  deleteItem(route('user.campaigns.destroy', deleteCampaigntId), 'Campaign');
});
listen('click', '.user-transaction-show-gift-btn', function (event) {
  $('#showGiftTransactionModal').appendTo('body').modal('show');
  var transactionId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.transaction.show') + '/' + transactionId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#userGiftFullName').html(result.data.full_name);
        $('#showGiftPaymentId').html(result.data.campaign_donation_transaction.transaction_id);
        $('#userGiftEmail').html(!isEmpty(result.data.email) ? result.data.email : 'N/A');
        var campaignCurrencySymbol = $('#campaignGiftCurrencySymbol').val();
        var amount = campaignCurrencySymbol + ' ' + addCommas(result.data.donated_amount.toFixed(2).toString());
        $('#showGiftDonatedAmount').html(amount);
        $('#showGiftPaymentMethod').html(result.data.campaign_donation_transaction.payment_type);
        $('#showGiftPaymentDate').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        Livewire.emit('refresh');
        $('#showGiftTransactionModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/campaigns/create-edit.js":
/*!******************************************************!*\
  !*** ./resources/assets/js/campaigns/create-edit.js ***!
  \******************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadCampaignCreateEdit);
var campaignDescriptionCreateQuill;
var editCampaignDescriptionQuill;

function loadCampaignCreateEdit() {
  if ($('#giftStatus').is(':checked')) {
    $('.gift-div').removeClass('d-none');
  } else {
    $('.gift-div').addClass('d-none');
  }

  if ($('#selectGiftId').length) {
    $('#selectGiftId').select2({
      placeholder: 'Select Gifts',
      allowClear: true
    });
  }

  var campaignStartDateEle = $('#campaignStartDate');
  var campaignDeadlineDateEle = $('#campaignDeadlineDate');

  if (campaignStartDateEle.length) {
    campaignStartDateEle.flatpickr({
      altInput: true,
      altFormat: "J F, Y",
      dateFormat: 'Y-m-d ',
      minDate: "today"
    });
  }

  if (campaignDeadlineDateEle.length) {
    campaignDeadlineDateEle.flatpickr({
      altInput: true,
      altFormat: 'J F, Y',
      dateFormat: 'Y-m-d ',
      minDate: 'today'
    });
  }

  if ($('#campaignIsEdit').length || $('#editCampaignFieldForm').length) {
    var campaignDeadlineDate = undefined;

    if ($('campaignId').length) {
      $('#campaignStartDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        minDate: moment(new Date()).format('YYYY-MM-DD'),
        onChange: function onChange(selectedDates, dateStr, instance) {
          var campaignStartMinDate = moment($('#campaignStartDate').val()).format();

          if (typeof followUpDate != 'undefined') {
            followUpDate.set('minDate', campaignStartMinDate);
          }
        }
      });
    } else {
      $('#campaignStartDate').flatpickr({
        format: 'YYYY-MM-DD',
        useCurrent: true,
        sideBySide: true,
        minDate: moment(new Date()).format('YYYY-MM-DD'),
        onChange: function onChange(selectedDates, dateStr, instance) {
          var campaignStartMinDate = moment($('#campaignStartDate').val()).format();

          if (typeof campaignDeadlineDate != 'undefined') {
            campaignDeadlineDate.set('minDate', campaignStartMinDate);
          }
        }
      });
    }

    campaignDeadlineDate = $('#campaignDeadlineDate').flatpickr({
      format: 'YYYY-MM-DD',
      useCurrent: true,
      sideBySide: true
    });
    var campaignStartMinDate = moment($('#campaignStartDate').val()).format();
    campaignDeadlineDate.set('minDate', campaignStartMinDate);
  }

  if ($('#currencyType').length) {
    $('#currencyType').select2();
  }

  if ($('#campaignCreateTitle').length && $('#campaignCreateSlug').length) {
    $('#campaignCreateTitle').keyup(function () {
      var campaignCreateTitle = $('#campaignCreateTitle').val();
      $('#campaignCreateSlug').val(campaignCreateTitle.toLowerCase().replace(/\s+/g, '-'));
      var campaignCreateSlug = $('#campaignCreateSlug').val();

      if (campaignCreateSlug.length > 15) {
        $('#campaignCreateSlug').val(campaignCreateSlug.substr(0, 15));
      }
    });
  }

  var bindings = {
    // This will overwrite the default binding also named 'tab'
    tab: {
      key: 9,
      handler: function handler() {// Handle tab
      }
    }
  };

  if ($('#campaignDescriptionCreateId').length) {
    campaignDescriptionCreateQuill = new Quill('#campaignDescriptionCreateId', {
      modules: {
        toolbar: [[{
          header: [1, 2, false]
        }], ['bold', 'italic', 'underline'], ['image', 'code-block']],
        keyboard: {
          bindings: bindings
        }
      },
      placeholder: 'Description',
      theme: 'snow'
    });
    campaignDescriptionCreateQuill.on('text-change', function (delta, oldDelta, source) {
      if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
        campaignDescriptionCreateQuill.setContents([{
          insert: ''
        }]);
      }

      $('#campaignCreateDescription').val(campaignDescriptionCreateQuill.root.innerHTML);
    });
  }

  if ($('#editCampaignDescriptionId').length) {
    editCampaignDescriptionQuill = new Quill('#editCampaignDescriptionId', {
      modules: {
        toolbar: [[{
          header: [1, 2, false]
        }], ['bold', 'italic', 'underline'], ['image', 'code-block']],
        keyboard: {
          bindings: bindings
        }
      },
      placeholder: 'Description',
      theme: 'snow'
    });
    editCampaignDescriptionQuill.on('text-change', function (delta, oldDelta, source) {
      if (editCampaignDescriptionQuill.getText().trim().length === 0) {
        editCampaignDescriptionQuill.setContents([{
          insert: ''
        }]);
      }

      $('#editCampaignDescription').val(editCampaignDescriptionQuill.root.innerHTML);
    });
    var editCampaignDescriptionData = $('#editCampaignDescriptionData').val();
    var element = document.createElement('textarea');
    element.innerHTML = editCampaignDescriptionData;
    editCampaignDescriptionQuill.root.innerHTML = element.value;
  }

  if ($('#campaignImageDropZone').length) {
    var campaignDropZoneId = $('#campaignId').val();
    new Dropzone('#campaignImageDropZone', {
      url: route('campaign.file.store', campaignDropZoneId),
      paramName: 'file',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      maxFiles: 10,
      acceptedFiles: '.jpg, .jpeg, .png',
      maxFilesize: 10,
      addRemoveLinks: true,
      success: function success() {
        $('.dz-message').addClass('d-none');
        displaySuccessMessage('File uploaded successfully.');
      },
      removedfile: function removedfile(file) {
        var campaignDropZoneId = $('#campaignId').val();
        var name = file.name;
        $.ajax({
          type: 'POST',
          url: route('remove.campaign.file'),
          data: {
            'file': name,
            'id': campaignDropZoneId
          },
          success: function success(result) {
            if (result.success) {
              if (result.data.length == 0) {
                $('.dz-message').removeClass('d-none');
              }

              displaySuccessMessage(result.message);
            }
          }
        });

        var _ref;

        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      },
      init: function init() {
        var dpzMultipleFiles = this;
        $.ajax({
          url: route('get.campaign.file', campaignDropZoneId),
          type: 'get',
          dataType: 'json',
          success: function success(response) {
            $.each(response.data, function (key, value) {
              if (value.name.length) {
                $('.dz-message').addClass('d-none');
              }

              if (value.name.length == '') {
                $('.dz-message').removeClass('d-none');
              }

              var mockFile = {
                name: value.name,
                size: value.size
              };
              dpzMultipleFiles.emit('addedfile', mockFile);
              dpzMultipleFiles.emit('complete', mockFile);
              dpzMultipleFiles.emit('thumbnail', mockFile, value.url);
            });
          }
        });
      }
    });
  }

  if ($('#userCampaignImageDropZone').length) {
    var _campaignDropZoneId = $('#userCampaignId').val();

    new Dropzone('#userCampaignImageDropZone', {
      url: route('user.campaign.file.store', _campaignDropZoneId),
      paramName: 'file',
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      maxFiles: 10,
      acceptedFiles: '.jpg, .jpeg, .png',
      maxFilesize: 10,
      addRemoveLinks: true,
      success: function success() {
        $('.dz-message').addClass('d-none');
        displaySuccessMessage('File uploaded successfully.');
      },
      removedfile: function removedfile(file) {
        var name = file.name;
        $.ajax({
          type: 'POST',
          url: route('user.remove.campaign.file'),
          data: {
            'file': name,
            'id': _campaignDropZoneId
          },
          success: function success(result) {
            if (result.data.length == 0) {
              $('.dz-message').removeClass('d-none');
            }

            displaySuccessMessage(result.message);
          }
        });

        var _ref;

        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      },
      init: function init() {
        var dpzMultipleFiles = this;
        $.ajax({
          url: route('user.get.campaign.file', _campaignDropZoneId),
          type: 'get',
          dataType: 'json',
          success: function success(response) {
            $.each(response.data, function (key, value) {
              if (value.name.length) {
                $('.dz-message').addClass('d-none');
              }

              if (value.name.length == '') {
                $('.dz-message').removeClass('d-none');
              }

              var mockFile = {
                name: value.name,
                size: value.size
              };
              dpzMultipleFiles.emit('addedfile', mockFile);
              dpzMultipleFiles.emit('complete', mockFile);
              dpzMultipleFiles.emit('thumbnail', mockFile, value.url);
            });
          }
        });
      }
    });
  }
}

listen('submit', '#editCampaignFieldForm', function (e) {
  e.preventDefault();
  $('#editCampaignFieldBtnSave').prop('disabled', true);
  var regexp = /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
  var validUrl = regexp.test($('#video_link').val());

  if (!isEmpty($('#video_link').val()) && !validUrl) {
    $('#editCampaignFieldBtnSave').prop('disabled', false);
    displayErrorMessage('Video URL is invalid.');
    return false;
  }

  var campaignId = $('#campaignId').val();
  $.ajax({
    url: route('update.field', campaignId),
    method: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addDefineGoal').removeClass('active show');
        $('#addGallery').addClass('active show');
        $('#add-gallery-tab').addClass('active');
        $('#add-define-goal').removeClass('active');
        $('#editCampaignFieldBtnSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editCampaignFieldBtnSave').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editCampaignFieldForm', '#editCampaignFieldBtnSave');
    }
  });
});
listen('submit', '#campaignCreateForm', function () {
  if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
    displayErrorMessage('The description field is required.');
    return false;
  }

  if (campaignDescriptionCreateQuill.getText().trim().length > 10000) {
    displayErrorMessage('The description is too long.');
    return false;
  }

  $('#btnSubmit').prop('disabled', true);
});
listen('submit', '#userCampaignCreateForm', function () {
  if (campaignDescriptionCreateQuill.getText().trim().length === 0) {
    displayErrorMessage('The description field is required.');
    return false;
  }

  if (campaignDescriptionCreateQuill.getText().trim().length > 10000) {
    displayErrorMessage('The description is too long.');
    return false;
  }

  $('#btnSubmit').prop('disabled', true);
});
listen('submit', '#campaignEditForm', function () {
  if (editCampaignDescriptionQuill.getText().trim().length === 0) {
    displayErrorMessage('The description field is required.');
    return false;
  }

  if (editCampaignDescriptionQuill.getText().trim().length > 10000) {
    displayErrorMessage('The description is too long.');
    return false;
  }

  if ($('#giftStatus').prop('checked')) {
    if ($('#selectGiftId').val().length === 0) {
      displayErrorMessage('Gifts field is required.');
      return false;
    }
  }

  var editor_content = editCampaignDescriptionQuill.root.innerHTML;
  var input = JSON.stringify(editor_content);
  $('#editCampaignDescription').val(input.replace(/"/g, ''));
  $('#editCampaignBtn').prop('disabled', true);
});
listen('submit', '#userEditCampaignFieldForm', function (e) {
  e.preventDefault();
  var regexp = /(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/gi;
  var validUrl = regexp.test($('#video_link').val());

  if (!isEmpty($('#video_link').val()) && !validUrl) {
    displayErrorMessage('Video URL is invalid.');
    return false;
  }

  var userCampaignId = $('#userCampaignId').val();
  $.ajax({
    url: route('user.update.field', userCampaignId),
    method: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addDefineGoal').removeClass('active show');
        $('#addGallery').addClass('active show');
        $('#addGalleryBtn').addClass('active');
        $('#addDefineGoalBtn').removeClass('active');
        $('#userEditCampaignFieldBtnSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#userEditCampaignFieldBtnSave').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#userEditCampaignFieldForm', '#userEditCampaignFieldBtnSave');
    }
  });
});
listen('click', '#giftStatus', function () {
  if ($('#giftStatus').is(':checked')) {
    $('.gift-div').removeClass('d-none');
  } else {
    $('.gift-div').addClass('d-none');
  }
});

/***/ }),

/***/ "./resources/assets/js/countries/country.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/countries/country.js ***!
  \**************************************************/
/***/ (() => {

"use strict";


listen('click', '#addCountryBtn', function () {
  $('#addCountryModal').appendTo('body').modal('show');
  resetModalForm('#addCountryForm');
});
listen('submit', '#addCountryForm', function (e) {
  e.preventDefault();
  processingBtn('#addCountryForm', '#CountryBtn', 'loading');
  $.ajax({
    url: route('countries.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#addCountryModal').modal('hide');
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#addCountryForm', '#btnSave');
    }
  });
});
listen('click', '.country-edit-btn', function (event) {
  var editCountryId = $(event.currentTarget).data('id');
  renderCountryData(editCountryId);
});

function renderCountryData(id) {
  $.ajax({
    url: route('countries.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#editCountryId').val(result.data.id);
        $('#editName').val(result.data.country_name);
        $('#editCountryModal').modal('show').appendTo('body');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listen('submit', '#editCountryForm', function (event) {
  event.preventDefault();
  processingBtn('#editCountryForm', '#btnEditSave', 'loading');
  var id = $('#editCountryId').val();
  $.ajax({
    url: route('countries.update', id),
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editCountryModal').modal('hide');
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#editCountryForm', '#btnEditSave');
    }
  });
});
listen('click', '.country-delete-btn', function (event) {
  var deleteCountryId = $(event.currentTarget).data('id');
  deleteItem(route('countries.destroy', deleteCountryId), 'Country');
});

/***/ }),

/***/ "./resources/assets/js/custom/custom.js":
/*!**********************************************!*\
  !*** ./resources/assets/js/custom/custom.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var source = null;

var jsrender = __webpack_require__(/*! jsrender */ "./node_modules/jsrender/jsrender.js");

var csrfToken = $('meta[name="csrf-token"]').attr('content');
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': csrfToken
  }
});
document.addEventListener('turbo:load', initAllComponents);
var firstTime = true;

function initAllComponents() {
  select2initialize();
  refreshCsrfToken();
  IOInitImageComponent();
  alertInitialize();
  modalInputFocus();
  inputFocus();
  togglePassword();
  tooltip();
  IOInitSidebar();
  initComponent();
}

function initComponent() {
  if (firstTime) {
    firstTime = false;
    return;
  }

  IOInitSideBarCollapse();
}

function tooltip() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}

var inputFocus = function inputFocus() {
  $('input:text:not([readonly="readonly"]):not([name="search"]):not(.front-input)').first().focus();
};

var modalInputFocus = function modalInputFocus() {
  $(function () {
    $('.modal').on('shown.bs.modal', function () {
      if ($(this).find('input:text')[0]) {
        $(this).find('input:text')[0].focus();
      }
    });
  });
};

function alertInitialize() {
  $('.alert').delay(5000).slideUp(300);
}

function refreshCsrfToken() {
  csrfToken = $('meta[name="csrf-token"]').attr('content');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': csrfToken
    }
  });
}

function select2initialize() {
  $('[data-control="select2"]').each(function () {
    $(this).select2();
  });
}

document.addEventListener('click', function (e) {
  var filterBtnEle = $(e.target).closest('.show[data-ic-dropdown-btn="true"]');
  var filterDropDownEle = $(e.target).closest('.show[data-ic-dropdown="true"]');

  if (!(filterBtnEle.length > 0 || filterDropDownEle.length > 0)) {
    $('[data-ic-dropdown-btn="true"]').removeClass('show');
    $('[data-ic-dropdown="true"]').removeClass('show');
  }
});

window.openDropdownManually = function (dropdownBtnEle, dropdownEle) {
  if (!dropdownBtnEle.hasClass('show')) {
    dropdownBtnEle.addClass('show');
    dropdownEle.addClass('show');
  } else {
    dropdownBtnEle.removeClass('show');
    dropdownEle.removeClass('show');
  }
};

window.hideDropdownManually = function (dropdownBtnEle, dropdownEle) {
  dropdownBtnEle.removeClass('show');
  dropdownEle.removeClass('show');
};

document.addEventListener('livewire:load', function () {
  window.livewire.hook('message.processed', function () {
    $('[data-control="select2"]').each(function () {
      $(this).select2();
    });
  });
});
$(document).ajaxComplete(function () {
  // Required for Bootstrap tooltips in DataTables
  $('[data-toggle="tooltip"]').tooltip({
    'html': true,
    'offset': 10
  });
});
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};

window.resetModalForm = function (formId, validationBox) {
  $(formId)[0].reset();
  $('select.select2Selector').each(function (index, element) {
    var drpSelector = '#' + $(this).attr('id');
    $(drpSelector).val('');
    $(drpSelector).trigger('change');
  });
  $(validationBox).hide();
};

window.printErrorMessage = function (selector, errorResult) {
  $(selector).show().html('');
  $(selector).text(errorResult.responseJSON.message);
};

window.manageAjaxErrors = function (data) {
  var errorDivId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'editValidationErrorsBox';

  if (data.status == 404) {
    toastr.error(data.responseJSON.message);
  } else {
    printErrorMessage('#' + errorDivId, data);
  }
};

window.displaySuccessMessage = function (message) {
  toastr.success(message);
};

window.displayErrorMessage = function (message) {
  toastr.error(message);
};

window.deleteItem = function (url, header) {
  var callFunction = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
  swal({
    title: 'Delete !',
    text: 'Are you sure want to delete this "' + header + '" ?',
    buttons: {
      confirm: 'Yes, Delete!',
      cancel: 'No, Cancel'
    },
    reverseButtons: true,
    icon: sweetAlertIcon
  }).then(function (willDelete) {
    if (willDelete) {
      deleteItemAjax(url, header, callFunction);
    }
  });
};

function deleteItemAjax(url, header) {
  var callFunction = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  $.ajax({
    url: url,
    type: 'DELETE',
    dataType: 'json',
    success: function success(obj) {
      if (obj.success) {
        window.Livewire.emit('resetPageTable');
        livewire.emit('refresh');
        window.livewire.emit('refreshDatatable');
        window.livewire.emit('resetPage');
      }

      swal({
        icon: 'success',
        title: 'Deleted!',
        text: header + ' has been deleted.',
        timer: 2000
      });

      if (callFunction) {
        eval(callFunction);
      }
    },
    error: function error(data) {
      swal({
        title: 'Error',
        icon: 'error',
        text: data.responseJSON.message,
        type: 'error',
        timer: 4000
      });
    }
  });
}

window.format = function (dateTime) {
  var format = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'DD-MMM-YYYY';
  return moment(dateTime).format(format);
};

window.processingBtn = function (selecter, btnId) {
  var state = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  var loadingButton = $(selecter).find(btnId);

  if (state === 'loading') {
    loadingButton.button('loading');
  } else {
    loadingButton.button('reset');
  }
};

window.prepareTemplateRender = function (templateSelector, data) {
  var template = jsrender.templates(templateSelector);
  return template.render(data);
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
  var ext = $(inputSelector).val().split('.').pop().toLowerCase();

  if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
    $(inputSelector).val('');
    $(validationMessageSelector).removeClass('d-none');
    $(validationMessageSelector).html('The image must be a file of type: jpeg, jpg, png.').show();
    $(validationMessageSelector).delay(5000).slideUp(300);
    return false;
  }

  $(validationMessageSelector).hide();
  return true;
};

window.displayPhoto = function (input, selector) {
  var displayPreview = true;

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var image = new Image();
      image.src = e.target.result;

      image.onload = function () {
        $(selector).attr('src', e.target.result);
        displayPreview = true;
      };
    };

    if (displayPreview) {
      reader.readAsDataURL(input.files[0]);
      $(selector).show();
    }
  }
};

window.removeCommas = function (str) {
  return str.replace(/,/g, '');
};

window.DatetimepickerDefaults = function (opts) {
  return $.extend({}, {
    sideBySide: true,
    ignoreReadonly: true,
    icons: {
      close: 'fa fa-times',
      time: 'fa fa-clock-o',
      date: 'fa fa-calendar',
      up: 'fa fa-arrow-up',
      down: 'fa fa-arrow-down',
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-clock-o',
      clear: 'fa fa-trash-o'
    }
  }, opts);
};

window.isEmpty = function (value) {
  return value === undefined || value === null || value === '';
};

window.screenLock = function () {
  $('#overlay-screen-lock').show();
  $('body').css({
    'pointer-events': 'none',
    'opacity': '0.6'
  });
};

window.screenUnLock = function () {
  $('body').css({
    'pointer-events': 'auto',
    'opacity': '1'
  });
  $('#overlay-screen-lock').hide();
};

window.onload = function () {
  window.startLoader = function () {
    $('.infy-loader').show();
  };

  window.stopLoader = function () {
    $('.infy-loader').hide();
  };

  stopLoader();
};

$(document).ready(function () {
  // script to active parent menu if sub menu has currently active
  var hasActiveMenu = $(document).find('.nav-item.dropdown ul li').hasClass('active');

  if (hasActiveMenu) {
    $(document).find('.nav-item.dropdown ul li.active').parent('ul').css('display', 'block');
    $(document).find('.nav-item.dropdown ul li.active').parent('ul').parent('li').addClass('active');
  }
});

window.urlValidation = function (value, regex) {
  var urlCheck = value == '' ? true : value.match(regex) ? true : false;

  if (!urlCheck) {
    return false;
  }

  return true;
};

$('.languageSelection').on('click', function () {
  var languageName = $(this).data('prefix-value');
  $.ajax({
    type: 'POST',
    url: '/change-language',
    data: {
      languageName: languageName
    },
    success: function success() {
      location.reload();
    }
  });
});

if ($(window).width() > 992) {
  $('.no-hover').on('click', function () {
    $(this).toggleClass('open');
  });
}

$(document).on('click', '#readNotification', function (e) {
  e.preventDefault();
  var notificationId = $(this).data('id');
  var notification = $(this);
  $.ajax({
    type: 'POST',
    url: readNotification + '/' + notificationId + '/read',
    data: {
      notificationId: notificationId
    },
    success: function success() {
      notification.remove();
      var notificationCounter = document.getElementsByClassName('readNotification').length;

      if (notificationCounter == 0) {
        $('#readAllNotification').addClass('d-none');
        $('.empty-state').removeClass('d-none');
        $('.notification-toggle').removeClass('beep');
      }
    },
    error: function error(_error) {
      manageAjaxErrors(_error);
    }
  });
});
$(document).on('click', '#readAllNotification', function (e) {
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: readAllNotifications,
    success: function success() {
      $('.readNotification').remove();
      $('#readAllNotification').addClass('d-none');
      $('.empty-state').removeClass('d-none');
      $('.notification-toggle').removeClass('beep');
    },
    error: function error(_error2) {
      manageAjaxErrors(_error2);
    }
  });
});
$('#register').on('click', function (e) {
  e.preventDefault();
  $('.open #dropdownLanguage').trigger('click');
  $('.open #dropdownLogin').trigger('click');
});
$('#language').on('click', function (e) {
  e.preventDefault();
  $('.open #dropdownRegister').trigger('click');
  $('.open #dropdownLogin').trigger('click');
});
$('#login').on('click', function (e) {
  e.preventDefault();
  $('.open #dropdownRegister').trigger('click');
  $('.open #dropdownLanguage').trigger('click');
});

window.checkSummerNoteEmpty = function (selectorElement, errorMessage) {
  var isRequired = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;

  if ($(selectorElement).summernote('isEmpty') && isRequired === 1) {
    displayErrorMessage(errorMessage);
    $(document).find('.note-editable').html('<p><br></p>');
    return false;
  } else if (!$(selectorElement).summernote('isEmpty')) {
    $(document).find('.note-editable').contents().each(function () {
      if (this.nodeType === 3) {
        // text node
        this.textContent = this.textContent.replace(/\u00A0/g, '');
      }
    });

    if ($(document).find('.note-editable').text().trim().length == 0) {
      $(document).find('.note-editable').html('<p><br></p>');
      $(selectorElement).val(null);

      if (isRequired === 1) {
        displayErrorMessage(errorMessage);
        return false;
      }
    }
  }

  return true;
};

window.preparedTemplate = function () {
  var source = $('#actionTemplate').html();
  window.preparedTemplate = Handlebars.compile(source);
};

window.ajaxCallInProgress = function () {
  ajaxCallIsRunning = true;
};

window.ajaxCallCompleted = function () {
  ajaxCallIsRunning = false;
};

window.avoidSpace = function (event) {
  var k = event ? event.which : window.event.keyCode;

  if (k == 32) {
    return false;
  }
};

listen('click', '#profileDropdownBtn', function () {
  openDropdownManually($('#profileDropdownBtn'), $('#profileDropdown'));
});
listen('click', '#languageDropdownBtn', function () {
  openDropdownManually($('#languageDropdownBtn'), $('#languageDropdown'));
});

window.addCommas = function (number) {
  number += '';
  var x = number.split('.');
  var x1 = x[0];
  var x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }

  return x1 + x2;
};

listenClick('.backendLanguage', function () {
  var languageName = $(this).attr('data-prefix-value');
  $.ajax({
    type: 'POST',
    url: route('change.language'),
    data: {
      languageName: languageName
    },
    success: function success(result) {
      displaySuccessMessage(result.message);
      setTimeout(function () {
        Turbo.visit(window.location.href);
      }, 1000);
    }
  });
});
jQuery(document).ready(function ($) {
  $('.aside-item-collapse > ul').hide();
  $('.aside-item-collapse').on('click', function () {
    $(this).toggleClass('collapse-menu').siblings().removeClass('collapse-menu');
    var $menuItem = $(this).children('.aside-submenu');
    $menuItem.stop(true, true).slideToggle('slow');
    $('.aside-submenu').not($menuItem).slideUp();
  });
});
listen('focus', '.select2.select2-container', function (e) {
  var isOriginalEvent = e.originalEvent; // don't re-open on closing focus event

  var isSingleSelect = $(this).find('.select2-selection--single').length > 0; // multi-select will pass focus to input

  if (isOriginalEvent && isSingleSelect) {
    $(this).siblings('select:enabled').select2('open');
  }
});
listen('select2:open', function () {
  var allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
  allFound[allFound.length - 1].focus();
});

function togglePassword() {
  $('[data-toggle="password"]').each(function () {
    var input = $(this);
    var eye_btn = $(this).parent().find('.input-icon');
    eye_btn.css('cursor', 'pointer').addClass('input-password-hide');
    eye_btn.on('click', function () {
      if (eye_btn.hasClass('input-password-hide')) {
        eye_btn.removeClass('input-password-hide').addClass('input-password-show');
        eye_btn.find('.bi').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        input.attr('type', 'text');
      } else {
        eye_btn.removeClass('input-password-show').addClass('input-password-hide');
        eye_btn.find('.bi').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        input.attr('type', 'password');
      }
    });
  });
}

/***/ }),

/***/ "./resources/assets/js/custom/helpers.js":
/*!***********************************************!*\
  !*** ./resources/assets/js/custom/helpers.js ***!
  \***********************************************/
/***/ (() => {

"use strict";


window.listen = function (event, selector, callback) {
  $(document).on(event, selector, callback);
};

window.listenClick = function (selector, callback) {
  $(document).on('click', selector, callback);
};

window.listenSubmit = function (selector, callback) {
  $(document).on('submit', selector, callback);
};

window.listenHiddenBsModal = function (selector, callback) {
  $(document).on('hidden.bs.modal', selector, callback);
};

window.listenChange = function (selector, callback) {
  $(document).on('change', selector, callback);
};

window.listenKeyup = function (selector, callback) {
  $(document).on('keyup', selector, callback);
};

/***/ }),

/***/ "./resources/assets/js/custom/phone-number-country-code.js":
/*!*****************************************************************!*\
  !*** ./resources/assets/js/custom/phone-number-country-code.js ***!
  \*****************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadPhoneNumberCountryCode);

function loadPhoneNumberCountryCode() {
  if (!$('#phoneNumber').length) {
    return;
  }

  var input = document.querySelector('#phoneNumber'),
      errorMsg = document.querySelector('#error-msg'),
      validMsg = document.querySelector('#valid-msg');
  var errorMap = ['Invalid number', 'Invalid country code', 'Too short', 'Too long', 'Invalid number']; // initialise plugin

  var intl = window.intlTelInput(input, {
    initialCountry: 'IN',
    separateDialCode: true,
    geoIpLookup: function geoIpLookup(success, failure) {
      $.get('https://ipinfo.io', function () {}, 'jsonp').always(function (resp) {
        var countryCode = resp && resp.country ? resp.country : '';
        success(countryCode);
      });
    },
    utilsScript: '../../public/assets/js/inttel/js/utils.min.js'
  });

  var reset = function reset() {
    input.classList.remove('error');
    errorMsg.innerHTML = '';
    errorMsg.classList.add('hide');
    validMsg.classList.add('hide');
  };

  input.addEventListener('blur', function () {
    reset();

    if (input.value.trim()) {
      if (intl.isValidNumber()) {
        validMsg.classList.remove('hide');
      } else {
        input.classList.add('error');
        var errorCode = intl.getValidationError();
        errorMsg.innerHTML = errorMap[errorCode];
        errorMsg.classList.remove('hide');
      }
    }
  }); // on keyup / change flag: reset

  input.addEventListener('change', reset);
  input.addEventListener('keyup', reset);

  if (typeof phoneNo != 'undefined' && phoneNo !== '') {
    setTimeout(function () {
      $('#phoneNumber').trigger('change');
    }, 500);
  }

  $(document).on('blur keyup change countrychange', '#phoneNumber', function () {
    if (typeof phoneNo != 'undefined' && phoneNo !== '') {
      intl.setNumber('+' + phoneNo);
      phoneNo = '';
    }

    var getCode = intl.selectedCountryData['dialCode'];
    $('#prefix_code').val(getCode);
  });

  if ($('#isEdit').val()) {
    var getCode = intl.selectedCountryData['dialCode'];
    $('#prefix_code').val(getCode);
  }

  var getPhoneNumber = $('#phoneNumber').val();
  var removeSpacePhoneNumber = getPhoneNumber.replace(/\s/g, '');
  $('#phoneNumber').val(removeSpacePhoneNumber);
}

listen('submit', '#userCreateForm', function (e) {
  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    return false;
  }
});
listen('submit', '#userEditForm', function (e) {
  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    return false;
  }
});
listen('submit', '#createSetting', function (e) {
  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    return false;
  }
});

/***/ }),

/***/ "./resources/assets/js/dashboard/dashboard.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/dashboard/dashboard.js ***!
  \****************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadDashboardData);
var donationWithdrawChartContainer = '';
var withdrawChartType = 'line';

function loadDashboardData() {
  donationWithdrawChartContainer = $('#donationWithdrawChartContainer');
  initDonationWithdrawChart();
}

var initDonationWithdrawChart = function initDonationWithdrawChart() {
  if (!donationWithdrawChartContainer.length) {
    return;
  }

  $.ajax({
    type: 'GET',
    url: route('donation.withdraw.chart'),
    dataType: 'json',
    success: function success(result) {
      donationWithdrawChart(result.data);
    },
    cache: false
  });
};

var donationWithdrawChart = function donationWithdrawChart(data) {
  $('#donationWithdrawChart').remove();
  $('#donationWithdrawChartContainer').append('<div id="donationWithdrawChart" style="height: 350px" class="card-rounded-bottom"></div>');
  var e = document.getElementById('donationWithdrawChart');
  e && new ApexCharts(e, {
    chart: {
      fontFamily: 'inherit',
      type: withdrawChartType,
      stacked: false,
      height: 350,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#0095E8', '#47BE7D'],
    series: [{
      name: 'Total Donation',
      data: data.donationData.dataset
    }, {
      name: 'Total Withdraw',
      data: data.withdrawDataset.dataset
    }],
    stroke: {
      curve: 'smooth',
      width: [4, 4],
      colors: ['#009EF7', '#47BE7D']
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '25%',
        endingShape: 'rounded'
      }
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: data.labels,
      labels: {
        style: {
          colors: '#A1A5B7',
          fontSize: '12px'
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#A1A5B7',
          fontSize: '12px'
        }
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      style: {
        fontSize: '12px'
      },
      y: {
        formatter: function formatter(e) {
          return '$' + ' ' + addCommas(e);
        }
      }
    },
    grid: {
      borderColor: '#EFF2F5',
      padding: {
        top: 0,
        right: 2,
        bottom: 0,
        left: 2
      }
    }
  }).render();
};

listenClick('#changeDonationWithdrawChart', function () {
  if (withdrawChartType === 'bar') {
    withdrawChartType = 'line';
    $('.chart').removeClass('fa-chart-line');
    $('.chart').addClass('fa-chart-bar');
    initDonationWithdrawChart();
  } else {
    withdrawChartType = 'bar';
    $('.chart').addClass('fa-chart-line');
    $('.chart').removeClass('fa-chart-bar');
    initDonationWithdrawChart();
  }
});

/***/ }),

/***/ "./resources/assets/js/dashboard/user-dashboard.js":
/*!*********************************************************!*\
  !*** ./resources/assets/js/dashboard/user-dashboard.js ***!
  \*********************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadUserDashboardData);
var userDonationWithdrawChartContainer = '';
var userWithdrawChartType = 'line';

function loadUserDashboardData() {
  userDonationWithdrawChartContainer = $('#userDonationWithdrawChartContainer');
  initUserDonationWithdrawChart();
}

var initUserDonationWithdrawChart = function initUserDonationWithdrawChart() {
  if (!userDonationWithdrawChartContainer.length) {
    return;
  }

  $.ajax({
    type: 'GET',
    url: route('user.donation.withdraw.chart'),
    dataType: 'json',
    success: function success(result) {
      userDonationWithdrawChart(result.data);
    },
    cache: false
  });
};

var userDonationWithdrawChart = function userDonationWithdrawChart(data) {
  $('#userDonationWithdrawChart').remove();
  $('#userDonationWithdrawChartContainer').append('<div id="userDonationWithdrawChart" style="height: 350px" class="card-rounded-bottom"></div>');
  var e = document.getElementById('userDonationWithdrawChart');
  e && new ApexCharts(e, {
    chart: {
      fontFamily: 'inherit',
      type: userWithdrawChartType,
      stacked: false,
      height: 350,
      toolbar: {
        show: false
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#0095E8', '#47BE7D'],
    series: [{
      name: 'Total Donation',
      data: data.donationData.dataset
    }, {
      name: 'Total Withdraw',
      data: data.withdrawDataset.dataset
    }],
    stroke: {
      curve: 'smooth',
      width: [4, 4],
      colors: ['#009EF7', '#47BE7D']
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '25%',
        endingShape: 'rounded'
      }
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: data.labels,
      labels: {
        style: {
          colors: '#A1A5B7',
          fontSize: '12px'
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#A1A5B7',
          fontSize: '12px'
        }
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      style: {
        fontSize: '12px'
      },
      y: {
        formatter: function formatter(e) {
          return '$' + ' ' + addCommas(e);
        }
      }
    },
    grid: {
      borderColor: '#EFF2F5',
      padding: {
        top: 0,
        right: 2,
        bottom: 0,
        left: 2
      }
    }
  }).render();
};

listenClick('#userChangeDonationWithdrawChart', function () {
  if (userWithdrawChartType === 'bar') {
    userWithdrawChartType = 'line';
    $('.chart').removeClass('fa-chart-line');
    $('.chart').addClass('fa-chart-bar');
    initUserDonationWithdrawChart();
  } else {
    userWithdrawChartType = 'bar';
    $('.chart').addClass('fa-chart-line');
    $('.chart').removeClass('fa-chart-bar');
    initUserDonationWithdrawChart();
  }
});

/***/ }),

/***/ "./resources/assets/js/donation_gifts/donation_gifts.js":
/*!**************************************************************!*\
  !*** ./resources/assets/js/donation_gifts/donation_gifts.js ***!
  \**************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadDonationGiftsData);

function loadDonationGiftsData() {
  var donationGiftDeliverytDate = $('#donationGiftDeliverytDate');

  if (donationGiftDeliverytDate.length) {
    donationGiftDeliverytDate.flatpickr({
      altInput: true,
      altFormat: "J F, Y",
      dateFormat: 'Y-m-d ',
      minDate: "today"
    });
  } // $(document).ready(function(){


  var maxField = 100;
  var addGiftButton = $('.add-gift');
  var giftFieldWrapper = $('.donationWrap');
  var giftFieldHTML = " <div class=\"gift-field-wrap row\">\n            <div class=\"col-11 form-group mr-5\">\n                <label for=\"name\" class=\"required mb-1\">Gift: </label>\n                <input type=\"text\" class=\"form-control\" name=\"gifts[createGift][]\" placeholder=\"Gift\" required>\n            </div>\n            <div class=\"d-flex action-wrap align-items-center col-1 mt-5\">\n                <a href=\"javascript:void(0)\" class=\"add-gift-add me-1\">\n                    <i class=\"fa fa-plus-circle fs-1 text-primary\"></i>\n                </a>\n                <a href=\"javascript:void(0)\"  data-bs-toggle=\"tooltip\"\n                   title=\"{{ __('messages.common.delete') }}\"\n                   class=\"btn px-1 text-danger fs-3 delete-gift\">\n                    <i class=\"fa-solid fa-trash\"></i>\n                </a>\n            </div>\n        </div>";
  var x = 1;
  $(addGiftButton).click(function () {
    if (x < maxField) {
      x++;
      $(giftFieldWrapper).append(giftFieldHTML);
    }
  });
  $(giftFieldWrapper).on('click', '.delete-gift', function (e) {
    e.preventDefault();
    $(this).offsetParent().remove();
    x--;
  });
  listen('click', '.add-gift-add', function (event) {
    if (x < maxField) {
      x++;
      $(giftFieldWrapper).append(giftFieldHTML);
    }
  });
}

listen('click', '.donation-gift-delete-btn', function (event) {
  var deleteDonationGiftId = $(event.currentTarget).data('id');
  deleteItem(route('donation-gifts.destroy', deleteDonationGiftId), 'Donation gift');
}); // listen('click', '.gift-delete-btn', function (event) {
//     let deleteGiftId = $(event.currentTarget).data('id')
//     deleteItem(route('donation.gift.destroy', deleteGiftId), 'Gift')
// })
//

listenClick('.gift-delete-btn', function (event) {
  var deleteGiftId = $(event.currentTarget).attr('data-id');
  swal({
    title: 'Delete !',
    text: 'Are you sure want to delete this "' + "Gift" + '" ?',
    icon: sweetAlertIcon,
    buttons: {
      confirm: 'Yes, Delete!',
      cancel: 'No, Cancel'
    },
    reverseButtons: true
  }).then(function (result) {
    if (result) {
      $.ajax({
        url: route('donation.gift.destroy', deleteGiftId),
        type: 'DELETE',
        success: function success(result) {
          if (result.success) {
            displaySuccessMessage(result.message);
          }

          swal({
            icon: 'success',
            title: 'Deleted!',
            text: 'Gift' + ' has been deleted.',
            type: 'success',
            timer: 2000
          });
          setTimeout(function () {
            Turbo.visit(window.location.href);
          }, 2000);
        },
        error: function error(data) {
          swal({
            title: 'Error',
            icon: 'error',
            text: data.responseJSON.message,
            type: 'error',
            timer: 4000
          });
        }
      });
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/email_subscribe/create_email_subscribe.js":
/*!***********************************************************************!*\
  !*** ./resources/assets/js/email_subscribe/create_email_subscribe.js ***!
  \***********************************************************************/
/***/ (() => {

"use strict";


listen('click', '.email-subscribe-delete-btn', function (event) {
  var recordId = $(event.currentTarget).data('id');
  deleteItem(route('email.subscribe.destroy', recordId), 'Subscriber');
});

/***/ }),

/***/ "./resources/assets/js/event-category/event-category.js":
/*!**************************************************************!*\
  !*** ./resources/assets/js/event-category/event-category.js ***!
  \**************************************************************/
/***/ (() => {

"use strict";


listen('click', '#addEventCategoryBtn', function () {
  $('#addEventCategoryModal').appendTo('body').modal('show');
  resetModalForm('#addEventCategoryForm');
  $('#previewImage').css('background-image', 'url("' + defaultEventCategoryImage + '")');
});
listen('submit', '#addEventCategoryForm', function (e) {
  e.preventDefault();
  processingBtn('#addEventCategoryForm', '#eventCategoryBtn', 'loading');
  $('#eventCategoryBtn').prop('disabled', true);
  $.ajax({
    url: route('event-categories.store'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#addEventCategoryModal').modal('hide');
      Livewire.emit('refresh');
      $('#eventCategoryBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#eventCategoryBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#addEventCategoryForm', '#btnSave');
    }
  });
});
listen('submit', '#editEventCategoryForm', function (event) {
  event.preventDefault();
  processingBtn('#editEventCategoryForm', '#btnEditSave', 'loading');
  $('#btnEditSave').prop('disabled', true);
  var id = $('#editEventCategoryId').val();
  $.ajax({
    url: route('event-categories.update', id),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editEventCategoryModal').modal('hide');
        Livewire.emit('refresh');
        $('#btnEditSave').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#btnEditSave').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editEventCategoryForm', '#btnEditSave');
    }
  });
});
listen('click', '.event-category-delete-btn', function (event) {
  var deleteEventCategoryId = $(event.currentTarget).data('id');
  var url = route('event-categories.destroy', {
    event_category: deleteEventCategoryId
  });
  deleteItem(url, 'Event Category');
});
listen('click', '.event-category-edit-btn', function (event) {
  var editEventCategoryId = $(event.currentTarget).data('id');
  renderEventCategoryData(editEventCategoryId);
});

function renderEventCategoryData(id) {
  $.ajax({
    url: route('event-categories.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#editEventCategoryId').val(result.data.id);
        $('#editName').val(result.data.name);

        if (isEmpty(result.data.image_url)) {
          $('#editPreviewImage').css('background-image', 'url("' + defaultEventCategoryImage + '")');
        } else {
          $('#editPreviewImage').css('background-image', 'url("' + result.data.image_url + '")');
        }

        result.data.is_active == 1 ? $('#editIsActive').prop('checked', true) : $('#editIsActive').prop('checked', false);
        $('#editIsActive').prop('disabled', false);

        if (result.data.events.length > 0) {
          $('#editIsActive').append('<input name="is_active_true" value="1">');
          $('#editIsActive').prop('disabled', true);
        }

        $('#editEventCategoryModal').modal('show').appendTo('body');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listen('click', '.isActive', function (event) {
  var eventCategoryId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'post',
    url: route('event-categories.status'),
    data: {
      id: eventCategoryId
    },
    success: function success(result) {
      Livewire.emit('refresh');
      displaySuccessMessage(result.message);
    }
  });
});
listen('change', '#eventCategoryStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#eventCategoryFilterBtn'), $('#eventCategoryFilter'));
});
listen('click', '#eventCategoryResetFilter', function () {
  $('#eventCategoryStatus').val(2).change();
  hideDropdownManually($('#eventCategoryFilterBtn'), $('#eventCategoryFilter'));
});
listen('click', '#eventCategoryFilterBtn', function () {
  openDropdownManually($('#eventCategoryFilterBtn'), $('#eventCategoryFilter'));
});

/***/ }),

/***/ "./resources/assets/js/events/create-edit.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/events/create-edit.js ***!
  \***************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadEventCreateEdit);

function loadEventCreateEdit() {
  var minTime = $('#startDate').val();
  var minDate = new Date();

  if ($('#endDate').length) {
    $('#endDate').flatpickr({
      enableTime: true,
      noCalendar: true,
      enableSeconds: true,
      dateFormat: 'H:i:S',
      time_24hr: true,
      minTime: minTime.split(':')[0] + ':' + parseInt(minTime.split(':')[1]) + 5
    });
  }

  if ($('#eventDate').length) {
    $('#eventDate').flatpickr({
      minDate: new Date(),
      dateFormat: 'Y-m-d'
    });
  }

  if ($('#eventIsEdit').length) {
    $('#eventDate').flatpickr({
      minDate: new Date(),
      dateFormat: 'Y-m-d'
    });
  }

  if ($('#startDate').length) {
    $('#startDate').flatpickr({
      enableTime: true,
      noCalendar: true,
      enableSeconds: true,
      dateFormat: 'H:i:S',
      time_24hr: true
    });
  }
}

listen('change', '#startDate', function () {
  var startTime = $('#startDate').val();
  var minTime = '"' + startTime + '"';
  $('#endDate').flatpickr({
    enableTime: true,
    noCalendar: true,
    enableSeconds: true,
    dateFormat: 'H:i:S',
    time_24hr: true,
    minTime: minTime.split(':')[0] + ':' + parseInt(minTime.split(':')[1]) + 5
  });

  if (startTime) {
    var endTime = $('#endDate').val();

    if (startTime > endTime) {
      $('#endDate').val('');
    }
  }
});
listen('keyup', '#eventCreateTitle', function () {
  var eventCreateTitle = $('#eventCreateTitle').val();
  $('#eventCreateSlug').val(eventCreateTitle.toLowerCase().replace(/\s+/g, '-'));
  var eventCreateSlug = $('#eventCreateSlug').val();

  if (eventCreateSlug.length > 15) {
    $('#eventCreateSlug').val(eventCreateSlug.substr(0, 15));
  }
});
listen('submit', '#eventCreateForm', function () {
  var websiteUrl = $('#event_organizer_website').val();
  var websiteExp = new RegExp(/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i);
  var websiteCheck = websiteUrl == '' ? true : websiteUrl.match(websiteExp) ? true : false;

  if (!websiteCheck) {
    displayErrorMessage('Please enter a valid event organizer website.');
    return false;
  }

  processingBtn('#eventCreateForm', '#btnEventSubmit', 'loading');
  $('#btnEventSubmit').prop('disabled', true);
});
listen('submit', '#eventEditForm', function () {
  var websiteUrl = $('#event_organizer_website').val();
  var endDate = $('#eventDate').val();

  if (endDate < moment().format('Y-MM-DD')) {
    displayErrorMessage('Event date must be greater then or equal to today date.');
    return false;
  }

  var websiteExp = new RegExp(/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i);
  var websiteCheck = websiteUrl == '' ? true : websiteUrl.match(websiteExp) ? true : false;

  if (!websiteCheck) {
    displayErrorMessage('Please enter a valid event organizer website.');
    return false;
  }

  processingBtn('#eventEditForm', '#btnEventSubmit', 'loading');
  $('#btnEventSubmit').prop('disabled', true);
});

/***/ }),

/***/ "./resources/assets/js/events/event-participate.js":
/*!*********************************************************!*\
  !*** ./resources/assets/js/events/event-participate.js ***!
  \*********************************************************/
/***/ (() => {

"use strict";


listen('click', '.event-participant-delete-btn', function (event) {
  var deleteParticipateId = $(event.currentTarget).data('id');
  var url = route('events.participate.destroy', {
    eventParticipant: deleteParticipateId
  });
  deleteItem(url, 'Event Participant');
});

/***/ }),

/***/ "./resources/assets/js/events/event.js":
/*!*********************************************!*\
  !*** ./resources/assets/js/events/event.js ***!
  \*********************************************/
/***/ (() => {

"use strict";


listen('click', '.event-delete-btn', function (event) {
  var deleteEventId = $(event.currentTarget).data('id');
  var url = route('events.destroy', {
    event: deleteEventId
  });
  deleteItem(url, 'Event');
});
listen('change', '#eventStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#eventFilterBtn'), $('#eventFilter'));
});
listen('click', '#eventResetFilter', function () {
  $('#eventStatus').val(3).change();
  hideDropdownManually($('#eventFilterBtn'), $('#eventFilter'));
});
listen('click', '#eventFilterBtn', function () {
  openDropdownManually($('#eventFilterBtn'), $('#eventFilter'));
});

/***/ }),

/***/ "./resources/assets/js/faqs/faqs.js":
/*!******************************************!*\
  !*** ./resources/assets/js/faqs/faqs.js ***!
  \******************************************/
/***/ (() => {

"use strict";


listen('click', '#addFaqs', function () {
  $('#creatFaqsModal').appendTo('body').modal('show');
  resetModalForm('#createFaqsForm');
});
listen('hidden.bs.modal', '#editFaqsModal', function () {
  resetModalForm('#editFaqsForm');
});
listen('click', '.faqs-edit-btn', function (event) {
  var editFaqsId = $(event.currentTarget).data('id');
  renderFaqsData(editFaqsId);
});

function renderFaqsData(id) {
  $.ajax({
    url: route('faqs.edit', id),
    type: 'GET',
    success: function success(result) {
      $('#faqsID').val(result.data.id);
      $('#editFaqsTitle').val(result.data.title);
      $('#editFaqsDescription').val(result.data.description);
      $('#editFaqsModal').modal('show');
    }
  });
}

listen('submit', '#createFaqsForm', function (e) {
  e.preventDefault();
  $('#createFaqsBtn').prop('disabled', true);
  $.ajax({
    url: route('faqs.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#creatFaqsModal').modal('hide');
        Livewire.emit('refresh');
        $('#createFaqsBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createFaqsBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editFaqsForm', function (e) {
  e.preventDefault();
  $('#editFaqsBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#faqsID').val();
  $.ajax({
    url: route('faqs.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editFaqsModal').modal('hide');
      displaySuccessMessage(result.message);
      Livewire.emit('refresh');
      $('#editFaqsBtn').prop('disabled', false);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editFaqsBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.faq-show-btn', function (event) {
  $('#showFaqModal').appendTo('body').modal('show');
  var faqId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('faqs.index') + '/' + faqId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#faqShowTitle').html(result.data.title);
        $('#faqShowCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#faqShowUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#faqShowDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showFaqModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '.faqs-delete-btn', function (event) {
  var deleteFaqsId = $(event.currentTarget).data('id');
  var url = route('faqs.destroy', {
    faq: deleteFaqsId
  });
  deleteItem(url, 'FAQ');
});

/***/ }),

/***/ "./resources/assets/js/front_slider/front_slider.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/front_slider/front_slider.js ***!
  \**********************************************************/
/***/ (() => {

"use strict";


listen('click', '.first-slider-delete-btn', function (event) {
  var deleteSliderId = $(event.currentTarget).data('id');
  deleteItem(route('sliders.destroy', deleteSliderId), 'Front Slider');
});
listen('submit', '#createSliderForm', function (e) {
  e.preventDefault();
  $('#saveSliderBtn').prop('disabled', true);
  $('#createSliderForm')[0].submit();
  return true;
});
listen('submit', '#editSliderForm', function (e) {
  e.preventDefault();
  $('#saveSliderBtn').prop('disabled', true);
  $('#editSliderForm')[0].submit();
  return true;
});

/***/ }),

/***/ "./resources/assets/js/inquiries/inquiries.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/inquiries/inquiries.js ***!
  \****************************************************/
/***/ (() => {

"use strict";


listen('click', '.inquiry-delete-btn', function (event) {
  var deleteInquiryID = $(event.currentTarget).data('id');
  var url = route('inquiries.destroy', {
    inquiry: deleteInquiryID
  });
  deleteItem(url, 'Inquiry');
});
listen('click', '.inquiry-show-btn', function (event) {
  $('#showInquiriesModal').appendTo('body').modal('show');
  var inquiryId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('inquiries.index') + '/' + inquiryId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showName').html(result.data.name);
        $('#showEmail').html(result.data.email);
        $('#showPhoneNo').html(result.data.phone);
        $('#showSubject').html(result.data.subject);
        $('#showCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#showUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.message) ? result.data.message : 'N/A';
        $('#showMessage').html(element.value);
        Livewire.emit('refresh');
        $('#showInquiriesModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('change', '#enquiriesStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'));
});
listen('click', '#enquiryResetFilter', function () {
  $('#enquiriesStatus').val(2).change();
  hideDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'));
});
listen('click', '#inquiriesFilterBtn', function () {
  openDropdownManually($('#inquiriesFilterBtn'), $('#inquiriesFilter'));
});

/***/ }),

/***/ "./resources/assets/js/languages/language_translate.js":
/*!*************************************************************!*\
  !*** ./resources/assets/js/languages/language_translate.js ***!
  \*************************************************************/
/***/ (() => {

"use strict";


listen('change', '.translateLanguage', function () {
  var lang = $(this).val();

  if (lang == '') {
    Turbo.visit(route('languages.translation', $('#indexLanguageId').val()));
  } else {
    Turbo.visit(route('languages.translation', $('#indexLanguageId').val()) + '?name=' + $('#indexSelectedLang').val() + '&file=' + file);
  }
});
listen('change', '#subFolderFiles', function () {
  var file = $(this).val();

  if (file == '') {
    Turbo.visit(route('languages.translation', $('#indexLanguageId').val()));
  } else {
    Turbo.visit(route('languages.translation', $('#indexLanguageId').val()) + '?name=' + $('#indexSelectedLang').val() + '&file=' + file);
  }
});
listen('click', '.addLanguageModal', function () {
  $('#addModal').appendTo('body').modal('show');
});
listen('hidden.bs.modal', '#addModal', function () {
  resetModalForm('#addNewForm', '#validationErrorsBox');
});

/***/ }),

/***/ "./resources/assets/js/languages/languages.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/languages/languages.js ***!
  \****************************************************/
/***/ (() => {

"use strict";


listen('click', '#addLanguage', function () {
  $('#addLanguageModal').appendTo('body').modal('show');
  resetModalForm('#addLanguageForm');
});
listen('click', '.language-delete-btn', function (event) {
  var languageId = $(event.currentTarget).attr('data-id');
  deleteItem(route('languages.destroy', languageId), 'Language');
});
listen('hidden.bs.modal', '#addLanguageModal', function () {
  resetModalForm('#addLanguageForm', '#languageValidationErrorsBox');
});
listen('hidden.bs.modal', '#editLanguageModal', function () {
  resetModalForm('#editLanguageForm', '#editValidationErrorsBox');
});
listen('submit', '#addLanguageForm', function (e) {
  e.preventDefault();
  processingBtn('#addLanguageForm', '#languageBtnSave', 'loading');
  $.ajax({
    url: route('languages.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#addLanguageModal').modal('hide');
        window.livewire.emit('refresh');
        setTimeout(function () {
          $('#languageBtnSave').button('reset');
        }, 1000);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      setTimeout(function () {
        $('#languageBtnSave').button('reset');
      }, 1000);
    },
    complete: function complete() {
      setTimeout(function () {
        processingBtn('#addLanguageForm', '#languageBtnSave');
      }, 1000);
    }
  });
});
listen('click', '.edit-language-btn', function (event) {
  var languageId = $(event.currentTarget).data('id');
  renderLanguageData(languageId);
});

function renderLanguageData(id) {
  $.ajax({
    url: route('languages.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#languageId').val(result.data.id);
        $('#editLanguage').val(result.data.name);
        $('#editIso').val(result.data.iso_code);
        $('#editLanguageModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listen('submit', '#editLanguageForm', function (event) {
  event.preventDefault();
  processingBtn('#editLanguageForm', '#btnEditSave', 'loading');
  var id = $('#languageId').val();
  $.ajax({
    url: route('languages.update', id),
    type: 'put',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editLanguageModal').modal('hide');
        window.livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {
      processingBtn('#editLanguageForm', '#btnEditSave');
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/news/create-edit.js":
/*!*************************************************!*\
  !*** ./resources/assets/js/news/create-edit.js ***!
  \*************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadNewsCreateEdit);
var newsDetailsQuill;

function loadNewsCreateEdit() {
  if (!$('#newsEditDetails').length) {
    newsDetailsQuill = null;
    return false;
  }

  if ($('#newsTagId').length) {
    $('#newsTagId').select2({
      placeholder: 'Tags',
      allowClear: true
    });
  }

  var bindings = {
    // This will overwrite the default binding also named 'tab'
    tab: {
      key: 9,
      handler: function handler() {// Handle tab
      }
    }
  };
  newsDetailsQuill = new Quill('#newsEditDetails', {
    modules: {
      toolbar: true,
      keyboard: {
        bindings: bindings
      }
    },
    placeholder: 'Type your text here...',
    theme: 'snow'
  });
  newsDetailsQuill.on('text-change', function (delta, oldDelta, source) {
    if (newsDetailsQuill.getText().trim().length === 0) {
      newsDetailsQuill.setContents([{
        insert: ''
      }]);
    }
  });

  if ($('#newsIsEdit').length) {
    if (!$('#newsIsEdit').val()) {
      return false;
    }

    var editNewsDescriptionData = $('#editNewsDescriptionData').val();
    var element = document.createElement('textarea');
    element.innerHTML = editNewsDescriptionData;
    newsDetailsQuill.root.innerHTML = element.value;
  }
}

listen('keyup', '#newsCreateTitle', function () {
  var newsCreateTitle = $('#newsCreateTitle').val();
  $('#newsCreateSlug').val(newsCreateTitle.toLowerCase().replace(/\s+/g, '-'));
  var newsCreateSlug = $('#newsCreateSlug').val();

  if (newsCreateSlug.length > 15) {
    $('#newsCreateSlug').val(newsCreateSlug.substr(0, 15));
  }
});
listen('submit', '#addNewsForm', function (e) {
  e.preventDefault();

  if (newsDetailsQuill.getText().trim().length === 0) {
    displayErrorMessage('The description field is required.');
    return false;
  }

  processingBtn('#addNewsForm', '#btnNewsSave', 'loading');
  $('#btnNewsSave').prop('disabled', true);
  var editor_content = newsDetailsQuill.root.innerHTML;
  var input = JSON.stringify(editor_content);
  $('#description').val(input.replace(/"/g, ''));
  $('#addNewsForm')[0].submit();
  return true;
});
listen('submit', '#editNewsForm', function (event) {
  event.preventDefault();

  if (newsDetailsQuill.getText().trim().length === 0) {
    displayErrorMessage('The description field is required.');
    return false;
  }

  processingBtn('#editNewsForm', '#btnNewsSave', 'loading');
  $('#btnNewsSave').prop('disabled', true);
  var editor_content = newsDetailsQuill.root.innerHTML;
  var input = JSON.stringify(editor_content);
  $('#description').val(input.replace(/"/g, ''));
  $('#editNewsForm')[0].submit();
  return true;
});

/***/ }),

/***/ "./resources/assets/js/news/news.js":
/*!******************************************!*\
  !*** ./resources/assets/js/news/news.js ***!
  \******************************************/
/***/ (() => {

"use strict";


listen('click', '.news-delete-btn', function (event) {
  var deleteNewsID = $(event.currentTarget).data('id');
  var url = route('news.destroy', {
    news: deleteNewsID
  });
  deleteItem(url, 'News');
});

/***/ }),

/***/ "./resources/assets/js/news_categories/news_categories.js":
/*!****************************************************************!*\
  !*** ./resources/assets/js/news_categories/news_categories.js ***!
  \****************************************************************/
/***/ (() => {

"use strict";


listen('click', '#addNewsCategoryBtn', function () {
  $('#createNewsCategoryModal').appendTo('body').modal('show');
  resetModalForm('#createNewsCategoryForm');
});
$('#editNewsCategoryModal').on('hidden.bs.modal', function () {
  resetModalForm('#editNewsCategoryForm', '#editNewsCategoryValidationErrorsBox');
});
listen('click', '.news-category-edit-btn', function (event) {
  var editNewsCategoryId = $(event.currentTarget).data('id');
  renderNewsCategoriesData(editNewsCategoryId);
});

function renderNewsCategoriesData(id) {
  $.ajax({
    url: route('news-categories.edit', id),
    type: 'GET',
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      $('#NewsCategoryID').val(result.data.id);
      $('#editNewsCategoryName').val(result.data.name);
      $('#editNewsCategoryModal').modal('show');
    }
  });
}

listen('submit', '#createNewsCategoryForm', function (e) {
  e.preventDefault();
  processingBtn('#createNewsCategoryForm', '#createNewsCategoryBtn', 'loading');
  $('#createNewsCategoryBtn').prop('disabled', true);
  $.ajax({
    url: route('news-categories.store'),
    type: 'POST',
    data: $(this).serialize(),
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createNewsCategoryModal').modal('hide');
        $('#createNewsCategoryBtn').prop('disabled', false);
        Livewire.emit('refresh');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createNewsCategoryBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editNewsCategoryForm', function (e) {
  e.preventDefault();
  $('#editNewsCategoryBtn').prop('disabled', true);
  var formData = $(this).serialize();
  var id = $('#NewsCategoryID').val();
  $.ajax({
    url: route('news-categories.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editNewsCategoryModal').modal('hide');
      displaySuccessMessage(result.message);
      $('#editNewsCategoryBtn').prop('disabled', false);
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editNewsCategoryBtn').prop('disabled', false);
    },
    complete: function complete() {}
  });
});
listen('click', '.news-category-delete-btn', function (event) {
  var deleteNewsCategoryID = $(event.currentTarget).data('id');
  var url = route('news-categories.destroy', {
    news_category: deleteNewsCategoryID
  });
  deleteItem(url, 'News Category');
});

/***/ }),

/***/ "./resources/assets/js/news_comments/news_comments.js":
/*!************************************************************!*\
  !*** ./resources/assets/js/news_comments/news_comments.js ***!
  \************************************************************/
/***/ (() => {

"use strict";


listen('hidden.bs.modal', '#editNewsCommentsModal', function () {
  resetModalForm('#editNewsCommentsForm');
});
listen('click', '.news-comment-edit-btn', function (event) {
  var editNewsCommentsId = $(event.currentTarget).data('id');
  renderNewsCommentsData(editNewsCommentsId);
});

function renderNewsCommentsData(id) {
  $.ajax({
    url: route('news-comments.edit', id),
    type: 'GET',
    success: function success(result) {
      Livewire.emit('refresh', 'refresh');
      $('#newsCommentsID').val(result.data.id);
      $('#editNewsComments').val(result.data.comments);
      $('#editNewsCommentsName').val(result.data.name);
      $('#editNewsCommentsEmail').val(result.data.email);
      $('#editNewsCommentsWebsiteName').val(result.data.website_name);
      $('#editNewsCommentsModal').modal('show');
    }
  });
}

listen('submit', '#editNewsCommentsForm', function (e) {
  e.preventDefault();
  var websiteUrl = $('#editNewsCommentsWebsiteName').val();
  var websiteExp = new RegExp(/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|](\.)+[-a-z]/i);
  var websiteCheck = websiteUrl == '' ? true : websiteUrl.match(websiteExp) ? true : false;

  if (!websiteCheck) {
    displayErrorMessage('Please enter a valid website name.');
    return false;
  }

  var formData = $(this).serialize();
  var id = $('#newsCommentsID').val();
  $.ajax({
    url: route('news-comments.update', id),
    type: 'PUT',
    data: formData,
    success: function success(result) {
      $('#editNewsCommentsModal').modal('hide');
      displaySuccessMessage(result.message);
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    },
    complete: function complete() {}
  });
});
listen('click', '.news-comment-delete-btn', function (event) {
  var deleteNewsCommentID = $(event.currentTarget).data('id');
  var url = route('news-comments.destroy', {
    news_comment: deleteNewsCommentID
  });
  deleteItem(url, 'Comment');
});

/***/ }),

/***/ "./resources/assets/js/news_tags/create_news_tags.js":
/*!***********************************************************!*\
  !*** ./resources/assets/js/news_tags/create_news_tags.js ***!
  \***********************************************************/
/***/ (() => {

"use strict";


listen('click', '.TagsBtn', function () {
  $('#createNewsTagsModal').appendTo('body').modal('show');
  resetModalForm('#createNewsTagsForm');
});
listen('submit', '#createNewsTagsForm', function (e) {
  e.preventDefault();
  processingBtn('#createNewsTagsForm', '#createNewsTagsBtn', 'loading');
  $('#createNewsTagsBtn').prop('disabled', true);
  $.ajax({
    url: route('news-tags.store'),
    type: 'POST',
    data: new FormData(this),
    processData: false,
    contentType: false,
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#createNewsTagsModal').modal('hide');
      $('#newsTagsTable').DataTable().ajax.reload(null, false);
      $('#createNewsTagsBtn').prop('disabled', false);
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createNewsTagsBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#createNewsTagsForm', '#createNewsTagsBtn');
    }
  });
});
listen('click', '.news-tags-edit-btn', function (event) {
  var eventId = $(event.currentTarget).data('id');
  renderNewsTagsData(eventId);
});

function renderNewsTagsData(id) {
  $.ajax({
    url: route('news-tags.edit', id),
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        Livewire.emit('refresh', 'refresh');
        $('#NewsTagsID').val(result.data.id);
        $('#editName').val(result.data.name);
        $('#editNewsTagsModal').modal('show').appendTo('body');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

listen('submit', '#editNewsTagsForm', function (e) {
  e.preventDefault();
  $('#editNewsTagsBtn').prop('disabled', true);
  var id = $('#NewsTagsID').val();
  $.ajax({
    url: route('news-tags.update', id),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      displaySuccessMessage(result.message);
      $('#editNewsTagsModal').modal('hide');
      $('#newsTagsTable').DataTable().ajax.reload(null, false);
      $('#editNewsTagsBtn').prop('disabled', false);
      Livewire.emit('refresh');
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editNewsTagsBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editNewsTagsForm', '#editNewsTagsBtn');
    }
  });
});

/***/ }),

/***/ "./resources/assets/js/news_tags/news_tags.js":
/*!****************************************************!*\
  !*** ./resources/assets/js/news_tags/news_tags.js ***!
  \****************************************************/
/***/ (() => {

"use strict";


listen('click', '.news-tags-delete-btn', function (event) {
  var deleteNewsTagsId = $(event.currentTarget).data('id');
  var url = route('news-tags.destroy', {
    news_tag: deleteNewsTagsId
  });
  deleteItem(url, 'News Tag');
});

/***/ }),

/***/ "./resources/assets/js/pages/create-edit.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/pages/create-edit.js ***!
  \**************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadPageCreateEdit);
var pageQuill;
var pageEditQuill;
var bindings = {
  // This will overwrite the default binding also named 'tab'
  tab: {
    key: 9,
    handler: function handler() {// Handle tab
    }
  }
};

function loadPageCreateEdit() {
  loadPageCreate();
  loadPageEdit();
}

function loadPageCreate() {
  if (!$('#pageDescription').length) {
    pageQuill = null;
    return;
  }

  pageQuill = new Quill('#pageDescription', {
    modules: {
      toolbar: true,
      keyboard: {
        bindings: bindings
      }
    },
    placeholder: 'Description',
    theme: 'snow'
  });
}

function loadPageEdit() {
  if (!$('#pageEditDescription').length) {
    pageEditQuill = null;
    return;
  }

  pageEditQuill = new Quill('#pageEditDescription', {
    modules: {
      toolbar: true,
      keyboard: {
        bindings: bindings
      }
    },
    placeholder: 'Description',
    theme: 'snow'
  });
  var element = document.createElement('textarea');
  element.innerHTML = $('#pageDescriptionData').val();
  pageEditQuill.root.innerHTML = element.value;
}

listen('submit', '#pageCreateForm', function () {
  processingBtn('#pageCreateForm', '#btnPageSubmit', 'loading');
  var editor_content = pageQuill.root.innerHTML;
  var input = JSON.stringify(editor_content);

  if (pageQuill.getText().trim().length === 0) {
    displayErrorMessage('Description field is required.');
    return false;
  }

  $('#description').val(input.replace(/"/g, ''));
});
listen('submit', '#pageEditForm', function () {
  processingBtn('#pageEditForm', '#btnPagedEditSave', 'loading');
  var editor_content = pageEditQuill.root.innerHTML;
  var input = JSON.stringify(editor_content);

  if (pageEditQuill.getText().trim().length === 0) {
    displayErrorMessage('Description field is required.');
    return false;
  }

  $('#description').val(input.replace(/"/g, ''));
});

/***/ }),

/***/ "./resources/assets/js/pages/pages.js":
/*!********************************************!*\
  !*** ./resources/assets/js/pages/pages.js ***!
  \********************************************/
/***/ (() => {

"use strict";


listen('click', '.delete-btn', function (event) {
  var deletePageId = $(event.currentTarget).data('id');
  var url = route('pages.destroy', {
    page: deletePageId
  });
  deleteItem(url, 'Page');
});
listen('click', '.page-active', function (event) {
  var pagStatusId = $(event.currentTarget).data('id');
  $.ajax({
    type: 'post',
    url: route('pages.status'),
    data: {
      id: pagStatusId
    },
    success: function success(result) {
      Livewire.emit('refresh');
      displaySuccessMessage(result.message);
    }
  });
});
listen('change', '#pageStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#pageFilterBtn'), $('#pageFilter'));
});
listen('click', '#pagesResetFilter', function () {
  $('#pageStatus').val(2).change();
  hideDropdownManually($('#pageFilterBtn'), $('#pageFilter'));
});
listen('click', '.page-show-btn', function (event) {
  $('#showPagesModal').appendTo('body').modal('show');
  var pageId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('pages.index') + '/' + pageId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        console.log(result.data);
        $('#showName').html(result.data.name);
        $('#showTitle').html(result.data.title);
        $('#showStatus').html(result.data.is_active == 1 ? 'yes' : 'No');
        $('#showCreatedAt').text(moment(result.data.created_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        $('#showUpdatedAt').text(moment(result.data.updated_at, 'YYYY-MM-DD hh:mm:ss').format('Do MMM, YYYY'));
        var element = document.createElement('textarea');
        element.innerHTML = !isEmpty(result.data.description) ? result.data.description : 'N/A';
        $('#showDescription').html(element.value);
        Livewire.emit('refresh');
        $('#showPagesModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('click', '#pageFilterBtn', function () {
  openDropdownManually($('#pageFilterBtn'), $('#pageFilter'));
});

/***/ }),

/***/ "./resources/assets/js/roles/roles.js":
/*!********************************************!*\
  !*** ./resources/assets/js/roles/roles.js ***!
  \********************************************/
/***/ (() => {

"use strict";


listen('click', '.role-delete-btn', function (event) {
  var deleteRoleId = $(event.currentTarget).data('id');
  var url = route('roles.destroy', {
    role: deleteRoleId
  });
  deleteItem(url, 'Role');
});
listen('click', '#checkAllPermission', function () {
  if ($('#checkAllPermission').is(':checked')) {
    $('.permission').each(function () {
      $(this).prop('checked', true);
    });
  } else {
    $('.permission').each(function () {
      $(this).prop('checked', false);
    });
  }
});
listen('click', '.permission', function () {
  if ($('.permission:checked').length === $('.permission').length) {
    $('#checkAllPermission').prop('checked', true);
  } else {
    $('#checkAllPermission').prop('checked', false);
  }
});

/***/ }),

/***/ "./resources/assets/js/second_front_slider/second_front_slider.js":
/*!************************************************************************!*\
  !*** ./resources/assets/js/second_front_slider/second_front_slider.js ***!
  \************************************************************************/
/***/ (() => {

"use strict";


listen('click', '.second-slider-delete-btn', function (event) {
  var deleteSecondSliderID = $(event.currentTarget).data('id');
  var url = route('second-slider.destroy', {
    second_slider: deleteSecondSliderID
  });
  deleteItem(url, 'Slider');
});
listen('submit', '#createFrontSlider2Form', function (e) {
  e.preventDefault();
  $('#saveSlider2Btn').prop('disabled', true);
  $('#createFrontSlider2Form')[0].submit();
  return true;
});
listen('submit', '#editFrontSlider2Form', function (e) {
  e.preventDefault();
  $('#saveSlider2Btn').prop('disabled', true);
  $('#editFrontSlider2Form')[0].submit();
  return true;
});

/***/ }),

/***/ "./resources/assets/js/settings/settings.js":
/*!**************************************************!*\
  !*** ./resources/assets/js/settings/settings.js ***!
  \**************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadSettingUpdate);

function loadSettingUpdate() {
  if ($('#credentialsSettings , #generalSettingFrom').length) {
    var chargeTypeCommission = $('#settingChargesType').val();
    settingChargeSymbol(chargeTypeCommission);
  }
}

listen('click', '.img-radio ', function () {
  $('.img-radio').removeClass('img-border');
  $(this).addClass('img-border');
  $('#homepage').val($(this).attr('data-id'));
});

function isEmailEditProfile(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

listen('submit', '#generalSettingFrom', function () {
  if ($('#error-msg').text() !== '') {
    $('#phoneNumber').focus();
    displayErrorMessage("Contact number is " + $('#error-msg').text());
    return false;
  }

  if (!isEmailEditProfile($('#email').val())) {
    displayErrorMessage('Please Enter valid Email.');
    return false;
  }
});
listen('click', '.stripe-enable', function () {
  $('.stripe-div').toggleClass('d-none');
});
listen('click', '.paypal-enable', function () {
  $('.paypal-div').toggleClass('d-none');
});
listenChange('#settingChargesType', function () {
  var chargeType = $('#settingChargesType').val();
  settingChargeSymbol(chargeType);
});

function settingChargeSymbol(chargeType) {
  $("#commission").trigger("keyup");

  if (chargeType == 1) {
    $('#commissionSymbol').text('Flat');
  } else {
    $('#commissionSymbol').text('%');
  }
}

listen('submit', '#credentialsSettings', function () {
  if ($('#stripeEnable').prop('checked')) {
    if ($('#stripeKey').val().trim().length === 0) {
      displayErrorMessage('Stripe key field is required');
      return false;
    } else if ($('#stripeSecret').val().trim().length === 0) {
      displayErrorMessage('Stripe secret field is required');
      return false;
    }
  }

  if ($('#paypalEnable').prop('checked')) {
    if ($('#paypalKey').val().trim().length === 0) {
      displayErrorMessage('Paypal key field is required');
      return false;
    } else if ($('#paypalSecret').val().trim().length === 0) {
      displayErrorMessage('Paypal secret field is required');
      return false;
    }
  } // let commissionPercentage = $('#commission').val()
  //
  // if (Number.isInteger(Number(commissionPercentage))) {
  //     if (commissionPercentage < 0 || commissionPercentage > 100) {
  //         displayErrorMessage(
  //             'Donation commission percentage required between 0 to 100.')
  //         return false
  //     }
  // } else {
  //     displayErrorMessage(
  //         'Donation commission percentage required integer number.')
  //     return false
  // }


  processingBtn('#credentialsSettings', '#credentialSettingBtn', 'loading');
  $('#credentialSettingBtn').prop('disabled', true);
});
listenKeyup("#commission", function () {
  var commissionType = $("#settingChargesType").val();
  var commissionValue = $("#commission").val();

  if (commissionType == "2" && commissionValue > 100) {
    $("#commission").val(0);
  }
});

/***/ }),

/***/ "./resources/assets/js/sidebar_menu_search/sidebar_menu_search.js":
/*!************************************************************************!*\
  !*** ./resources/assets/js/sidebar_menu_search/sidebar_menu_search.js ***!
  \************************************************************************/
/***/ (() => {

"use strict";


listen('keyup', '#menuSearch', function () {
  var value = $(this).val().toLowerCase();
  $('.nav-item').filter(function () {
    $('.no-record').addClass('d-none');
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    checkEmpty();
  });
});

function checkEmpty() {
  if ($('.nav-item:visible').last().length == 0) {
    $('.no-record').removeClass('d-none');
  }
}

listen('click', '.sidebar-aside-toggle', function () {
  if ($(this).hasClass('active') === true) {
    $('.sidebar-search-box').addClass('d-none');
  } else {
    $('.sidebar-search-box').removeClass('d-none');
  }
});

/***/ }),

/***/ "./resources/assets/js/success_story/success_story.js":
/*!************************************************************!*\
  !*** ./resources/assets/js/success_story/success_story.js ***!
  \************************************************************/
/***/ (() => {

"use strict";


listen('click', '.success-story-delete-btn', function (event) {
  var deleteSuccessStoryID = $(event.currentTarget).data('id');
  var url = route('success-stories.destroy', {
    success_story: deleteSuccessStoryID
  });
  deleteItem(url, 'Success Story');
});
listen('submit', '#addSuccessStoryForm', function () {
  $('#saveSuccessStoryBtn').prop('disabled', true);
  return true;
});
listen('submit', '#editSuccessStoryForm', function () {
  $('#saveSuccessStoryBtn').prop('disabled', true);
  return true;
});

/***/ }),

/***/ "./resources/assets/js/teams/teams.js":
/*!********************************************!*\
  !*** ./resources/assets/js/teams/teams.js ***!
  \********************************************/
/***/ (() => {

"use strict";


listen('click', '#addTeamBtn', function () {
  $('#createTeamModal').appendTo('body').modal('show');
  resetModalForm('#createTeamForm');
  $('#staffImage').css('background-image', 'url("' + defaultTeamImage + '")');
});
$('#editTeamModal').on('hidden.bs.modal', function () {
  resetModalForm('#editTeamForm', '#editTeamValidationErrorsBox');
});
listen('click', '.team-edit-btn', function (event) {
  var editTeamID = $(event.currentTarget).data('id');
  renderTeamData(editTeamID);
});

function renderTeamData(editTeamID) {
  $.ajax({
    url: route('team-members.edit', editTeamID),
    type: 'GET',
    success: function success(result) {
      $('#editTeamId').val(result.data.id);
      $('#editName').val(result.data.name);
      $('#editDesignation').val(result.data.designation);

      if (isEmpty(result.data.image_url)) {
        $('#editPreviewImage').css('background-image', 'url("' + defaultTeamImage + '")');
      } else {
        $('#editPreviewImage').css('background-image', 'url("' + result.data.image_url + '")');
      }

      $('#editTeamModal').modal('show');
    }
  });
}

listen('submit', '#createTeamForm', function (e) {
  e.preventDefault();
  $('#createTeamBtn').prop('disabled', true);
  $.ajax({
    url: route('team-members.store'),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#createTeamModal').modal('hide');
        Livewire.emit('refresh');
        $('#createTeamBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#createTeamBtn').prop('disabled', false);
    }
  });
});
listen('submit', '#editTeamForm', function (event) {
  event.preventDefault();
  $('#editTeamBtn').prop('disabled', true);
  processingBtn('#editTeamForm', '#btnEditSave', 'loading');
  var editTeamFormID = $('#editTeamId').val();
  $.ajax({
    url: route('teams.update', editTeamFormID),
    type: 'POST',
    data: new FormData($(this)[0]),
    processData: false,
    contentType: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        $('#editTeamModal').modal('hide');
        Livewire.emit('refresh');
        $('#editTeamBtn').prop('disabled', false);
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
      $('#editTeamBtn').prop('disabled', false);
    },
    complete: function complete() {
      processingBtn('#editTeamForm', '#btnEditSave');
    }
  });
});
listen('click', '.team-delete-btn', function (event) {
  var deleteTeamId = $(event.currentTarget).data('id');
  var url = route('team-members.destroy', {
    team_member: deleteTeamId
  });
  deleteItem(url, 'Team Member');
});

/***/ }),

/***/ "./resources/assets/js/terms-conditions/terms-conditions.js":
/*!******************************************************************!*\
  !*** ./resources/assets/js/terms-conditions/terms-conditions.js ***!
  \******************************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadTermAndCondition);
var termConditionQuill;
var privacyPolicyQuill;

function loadTermAndCondition() {
  if (!$('#termConditionId').length && !$('#privacyPolicyId').length) {
    termConditionQuill = null;
    privacyPolicyQuill = null;
    return false;
  }

  termConditionQuill = new Quill('#termConditionId', {
    modules: {
      toolbar: true
    },
    placeholder: 'Type your text here...',
    theme: 'snow'
  });
  termConditionQuill.on('text-change', function (delta, oldDelta, source) {
    if (termConditionQuill.getText().trim().length === 0) {
      termConditionQuill.setContents([{
        insert: ''
      }]);
    }
  });
  privacyPolicyQuill = new Quill('#privacyPolicyId', {
    modules: {
      toolbar: true
    },
    placeholder: 'Type your text here...',
    theme: 'snow'
  });
  privacyPolicyQuill.on('text-change', function (delta, oldDelta, source) {
    if (privacyPolicyQuill.getText().trim().length === 0) {
      privacyPolicyQuill.setContents([{
        insert: ''
      }]);
    }
  });
  var element = document.createElement('textarea');
  element.innerHTML = $('#termsConditionsData').val();
  termConditionQuill.root.innerHTML = element.value;
  element.innerHTML = $('#privacyPolicyData').val();
  privacyPolicyQuill.root.innerHTML = element.value;
}

listen('submit', '#editTermsConditionsForm', function (e) {
  e.stopImmediatePropagation();
  var element = document.createElement('textarea');
  var editor_content_1 = termConditionQuill.root.innerHTML;
  element.innerHTML = editor_content_1;
  var editor_content_2 = privacyPolicyQuill.root.innerHTML;
  $('#termsConditionsData').val(editor_content_1);
  $('#privacyPolicyData').val(editor_content_2);

  if (termConditionQuill.getText().trim().length === 0) {
    displayErrorMessage('The Terms & Conditions is required.');
    return false;
  }

  if (privacyPolicyQuill.getText().trim().length === 0) {
    displayErrorMessage('The Privacy Policy is required.');
    return false;
  }
});

/***/ }),

/***/ "./resources/assets/js/third_category/third_category.js":
/*!**************************************************************!*\
  !*** ./resources/assets/js/third_category/third_category.js ***!
  \**************************************************************/
/***/ (() => {

"use strict";


listen('click', '.third-category-delete-btn', function (event) {
  var deleteSliderId = $(event.currentTarget).data('id');
  var url = route('third-categories.destroy', {
    third_category: deleteSliderId
  });
  deleteItem(url, 'Category');
});
listen('submit', '#createFrontSlider3CategoryForm', function (e) {
  e.preventDefault();
  $('#saveSlider3CategoryBtn').prop('disabled', true);
  $('#createFrontSlider3CategoryForm')[0].submit();
  return true;
});
listen('submit', '#editFrontSlider3CategoryForm', function (e) {
  e.preventDefault();
  $('#saveSlider3CategoryBtn').prop('disabled', true);
  $('#editFrontSlider3CategoryForm')[0].submit();
  return true;
});

/***/ }),

/***/ "./resources/assets/js/third_front_slider/third_front_slider.js":
/*!**********************************************************************!*\
  !*** ./resources/assets/js/third_front_slider/third_front_slider.js ***!
  \**********************************************************************/
/***/ (() => {

"use strict";


listen('click', '.third-slider-delete-btn', function (event) {
  var deleteSliderId = $(event.currentTarget).data('id');
  var url = route('third-slider.destroy', {
    third_slider: deleteSliderId
  });
  deleteItem(url, 'Front Slider');
});
listen('submit', '#createFrontSlider3Form', function (e) {
  e.preventDefault();
  $('#saveSlider3Btn').prop('disabled', true);
  $('#createFrontSlider3Form')[0].submit();
  return true;
});
listen('submit', '#editFrontSlider3Form', function (e) {
  e.preventDefault();
  $('#saveSlider3Btn').prop('disabled', true);
  $('#editFrontSlider3Form')[0].submit();
  return true;
});

/***/ }),

/***/ "./resources/assets/js/turbo.js":
/*!**************************************!*\
  !*** ./resources/assets/js/turbo.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _hotwired_turbo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @hotwired/turbo */ "./node_modules/@hotwired/turbo/dist/turbo.es2017-esm.js");



window.Turbo = _hotwired_turbo__WEBPACK_IMPORTED_MODULE_0__;
_hotwired_turbo__WEBPACK_IMPORTED_MODULE_0__.start();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_hotwired_turbo__WEBPACK_IMPORTED_MODULE_0__);

/***/ }),

/***/ "./resources/assets/js/user_withdraw/withdraw.js":
/*!*******************************************************!*\
  !*** ./resources/assets/js/user_withdraw/withdraw.js ***!
  \*******************************************************/
/***/ (() => {

"use strict";


listen('click', '.user-withdraw-request-btn', function (event) {
  var id = $(event.currentTarget).attr('data-id');
  var campaignId = $(event.currentTarget).attr('data-campaign-id');
  var divAttr = document.createElement("div");
  var paymentType = paypalPaymentType;
  getCommission(campaignId, paymentType, id);
  divAttr.innerHTML = '<select type="text" id="paymentType" class="swal2-select swal2-input select2 form-select" name="selected_payment_gatway" required>' + '<option value="1" selected class="swal2-input">Paypal</option>' + '<option value="2"  class="swal2-input">Bank</option>' + '</select>' + '<input type="hidden" name="withdrawCampingId" id="withdrawCampingId" value="' + campaignId + '">' + '<input type="hidden" name="withdrawId" id="withdrawId" value="' + id + '">' + '<div class="form-check form-check-custom form-check-solid defautEmail mt-3 mb-3">\n' + '    <input class="form-check-input"  type="checkbox" id="defaultEmail"  checked/>\n' + '    <label class="form-check-label" for="defaultEmail">\n' + '        Default PayPal email\n' + '    </label>\n' + '</div>\n' + '<input type="text" id="email" class="swal2-input withdrawEmail d-none swal-content__input mb-2" placeholder="Enter paypal account email">' + '<input type="text" id="confirmEmail" class="swal2-input payPalWithdrawRequest swal-content__input" placeholder="Confirm paypal account email">' + '<div class="form-check form-check-custom form-check-solid defaultBank d-none mt-3 mb-3">\n' + '    <input class="form-check-input"  type="checkbox" id="defaultBank" checked/>\n' + '    <label class="form-check-label" for="defaultBank">\n' + '        Default bank detail\n' + '    </label>\n' + '</div>\n' + '<input type="text" id="accountNumber" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank account number">' + '<input type="text" id="isbnNumber" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank ISBN number">' + '<input type="text" id="branchName" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter bank branch name">' + '<input type="text" id="accountHolderName" class="swal2-input bankWithdrawRequest d-none swal-content__input mt-2" placeholder="Enter account holder name">' + '<textarea class="swal2-textarea swal-content__input mt-3" id="notes" placeholder="Type your message here" style="display: flex;"></textarea>';
  swal({
    title: 'Withdraw Request',
    content: divAttr,
    text: 'Are you sure want to  this withdraw amount ?',
    buttons: {
      confirm: 'Yes, Request Send',
      cancel: 'No, Cancel'
    },
    reverseButtons: true,
    icon: sweetWithdrawAlertIcon
  }).then(function (result) {
    if ($('#paymentType').val() == 1) {
      if ($('#defaultEmail').prop('checked') == true) {
        $('#email').val($('#defaultPayPal').val());
      }
    } else {
      if ($('#defaultBank').prop('checked') == true) {
        $('#accountNumber').val($('#defaultAccountNumber').val());
        $('#isbnNumber').val($('#defaultIsbnNumber').val());
        $('#branchName').val($('#defaultBranchName').val());
        $('#accountHolderName').val($('#defaultHolderName').val());
      }
    }

    var email = $('#email').val();
    var confirmEmail = $('#confirmEmail').val();
    var notes = $('#notes').val();
    var accountNumber = $('#accountNumber').val();
    var isbnNumber = $('#isbnNumber').val();
    var branchName = $('#branchName').val();
    var accountHolderName = $('#accountHolderName').val();
    var paymentType = $('#paymentType').val();

    if (result) {
      $.ajax({
        url: route('user.withdraw.store'),
        type: 'POST',
        data: {
          payment_type: paymentType,
          email: email,
          confirm_email: confirmEmail,
          user_notes: notes,
          campaign_id: campaignId,
          account_number: accountNumber,
          isbn_number: isbnNumber,
          branch_name: branchName,
          account_holder_name: accountHolderName,
          id: id
        },
        success: function success(obj) {
          if (obj.success) {
            window.livewire.emit('refresh');
          }

          swal({
            title: 'Sent',
            text: 'Withdraw request has been sent.',
            icon: 'success',
            timer: 2000,
            confirmButtonColor: '#009ef7'
          });
        },
        error: function error(data) {
          swal({
            title: 'Error',
            icon: 'error',
            text: data.responseJSON.message,
            type: 'error',
            timer: 5000,
            confirmButtonColor: '#009ef7'
          });
        }
      });
    }
  });
});
listenChange('#paymentType', function () {
  var paymentType = $(this).val();
  var payPalWithdrawRequest = 1;
  var bankWithdrawRequest = 2;

  if (paymentType == payPalWithdrawRequest) {
    $('.bankWithdrawRequest').addClass('d-none');
    $('.defaultBank').addClass('d-none');
    $('.payPalWithdrawRequest').removeClass('d-none');
    $('.defautEmail').removeClass('d-none');

    if ($('#defaultEmail').prop('checked') == false) {
      $('.withdrawEmail').removeClass('d-none');
    }
  }

  if (paymentType == bankWithdrawRequest) {
    $('.payPalWithdrawRequest').addClass('d-none');
    $('.withdrawEmail').addClass('d-none');
    $('.defautEmail').addClass('d-none');
    $('.bankWithdrawRequest').removeClass('d-none');
    $('.defaultBank').removeClass('d-none');

    if ($('#defaultBank').prop('checked') == true) {
      $('.bankWithdrawRequest').addClass('d-none');
    }
  }
});
listen('click', '#defaultEmail', function () {
  if ($(this).prop('checked') == false) {
    $('.withdrawEmail').removeClass('d-none');
  }

  if ($(this).prop('checked') == true) {
    $('.withdrawEmail').addClass('d-none');
  }
});
listen('click', '#defaultBank', function () {
  if ($(this).prop('checked') == false) {
    $('.bankWithdrawRequest').removeClass('d-none');
  }

  if ($(this).prop('checked') == true) {
    $('.bankWithdrawRequest').addClass('d-none');
  }
});
listen('click', '.withdraw-show-btn', function (event) {
  $('#showWithdrawModal').appendTo('body').modal('show');
  var requestId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.withdraw.index') + '/' + requestId,
    type: 'GET',
    success: function success(result) {
      if (result.success) {
        $('#showUserNotes').html(!isEmpty(result.data.user_notes) ? result.data.user_notes : 'N/A');
        $('#showAdminNotes').html(!isEmpty(result.data.admin_notes) ? result.data.admin_notes : 'N/A');
        Livewire.emit('refresh');
        $('#showWithdrawModal').appendTo('body').modal('show');
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});
listen('change', '#userWithdrawStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#userWithdrawStatusFilterBtn'), $('#userWithdrawFilter'));
});
listen('click', '#userWithdrawResetFilter', function () {
  $('#userWithdrawStatus').val(5).change();
  hideDropdownManually($('#userWithdrawStatusFilterBtn'), $('#userWithdrawFilter'));
});
listen('click', '#userWithdrawStatusFilterBtn', function () {
  openDropdownManually($('#userWithdrawStatusFilterBtn'), $('#userWithdrawFilter'));
});
listenChange('#paymentType', function (event) {
  var campaignId = $('#withdrawCampingId').val();
  var paymentType = $('#paymentType').val();
  var id = $('#withdrawId').val();
  getCommission(campaignId, paymentType, id);
});

function getCommission(campaignId, paymentType, withdrawId) {
  $.ajax({
    url: route('user.get-commission', campaignId),
    type: 'GET',
    data: {
      campaignId: campaignId,
      paymentType: paymentType,
      withdrawId: withdrawId
    },
    success: function success(result) {
      if (result.success) {
        $('#chargesCalculationTable').remove();
        $('.swal-content').append("\n                <table id=\"chargesCalculationTable\" class=\"table mt-3 mb-0\">\n                    <tr>\n                        <td class=\"text-start\">Donation Amount</td>\n                        <td class=\"text-end charges\">".concat(result.data.campaignAmount.toFixed(2), "</td>\n                    </tr>\n                    <tr class=\"border-bottom border-secondary\">\n                        <td class=\"text-start\">Charge Amount</td>\n                        <td class=\"text-end\">- ").concat(result.data.chargeAmount.toFixed(2), "</td>\n                    </tr>\n                    <tr>\n                        <td class=\"text-start\">Total Withdrawal Amount</td>\n                        <td class=\"text-end\">").concat(result.data.totalWithdrawalAmount.toFixed(2), "</td>\n                    </tr>\n                </table>\n                "));
      }
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
}

/***/ }),

/***/ "./resources/assets/js/users/user-profile.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/users/user-profile.js ***!
  \***************************************************/
/***/ (() => {

"use strict";


listen('click', '#changePassword', function () {
  $('#changePasswordModal').modal('show').appendTo('body');
  resetModalForm('#changePasswordForm');
  $('.active-class>div.active').removeClass('active');
});
listen('click', '#passwordChangeBtn', function () {
  $.ajax({
    url: route('user.changePassword'),
    type: 'PUT',
    data: $('#changePasswordForm').serialize(),
    success: function success(result) {
      $('#changePasswordModal').modal('hide');
      $('#changePasswordForm')[0].reset();
      displaySuccessMessage(result.message);
    },
    error: function error(result) {
      displayErrorMessage(result.responseJSON.message);
    }
  });
});

window.printErrorMessage = function (selector, errorResult) {
  $(selector).show().html('');
  $(selector).text(errorResult.responseJSON.message);
};

/***/ }),

/***/ "./resources/assets/js/users/user.js":
/*!*******************************************!*\
  !*** ./resources/assets/js/users/user.js ***!
  \*******************************************/
/***/ (() => {

"use strict";


listen('click', '.user-delete-btn', function (event) {
  var deleteUserId = $(event.currentTarget).data('id');
  deleteItem(route('users.destroy', deleteUserId), 'User');
});
listen('change', '.is-verified', function (event) {
  var userVerifyId = $(event.currentTarget).data('id');
  $.ajax({
    url: route('user.email.verify', userVerifyId),
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
        window.livewire.emit('refresh');
      }
    }
  });
});
listen('change', '.userIsActive', function (event) {
  var userStatusId = $(event.currentTarget).data('id');
  updateUserStatus(userStatusId);
});

function updateUserStatus(id) {
  $.ajax({
    url: route('user.status.active.deactive', id),
    method: 'post',
    cache: false,
    success: function success(result) {
      if (result.success) {
        displaySuccessMessage(result.message);
      }
    }
  });
}

var userFilterBtn = $('#userFilterBtn');
var userFilter = $('#userFilter');
listen('change', '#userStatus', function () {
  window.livewire.emit('changeFilter', 'statusFilter', $(this).val());
  hideDropdownManually($('#userFilterBtn'), $('#userFilter'));
});
listen('click', '#userResetFilter', function () {
  $('#userStatus').val(2).change();
  hideDropdownManually($('#userFilterBtn'), $('#userFilter'));
});
listen('click', '#userFilterBtn', function () {
  openDropdownManually($('#userFilterBtn'), $('#userFilter'));
});

function isEmailEditProfile(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

listenSubmit('#userCreateForm,#userEditForm', function () {
  if (!isEmailEditProfile($('#email').val())) {
    displayErrorMessage('Please Enter valid Email.');
    return false;
  }

  if ($('#password').val() != '') {
    if ($('#password').val() !== $('#cPassword').val()) {
      displayErrorMessage('The password and password confirmation must match.');
      return false;
    }
  }

  $('#btnSubmit').attr('disabled', true);
});

/***/ }),

/***/ "./resources/assets/js/withdrawal/withdrawal.js":
/*!******************************************************!*\
  !*** ./resources/assets/js/withdrawal/withdrawal.js ***!
  \******************************************************/
/***/ (() => {

"use strict";


document.addEventListener('turbo:load', loadAdminWithdrawSetting);

function loadAdminWithdrawSetting() {
  if ($('#editWithdrawSetting').length) {
    var chargeTypeCommission = $('#editDiscountType').val();
    settingWithdrawChargeSymbol(chargeTypeCommission);
  }
}

listenChange('#editDiscountType', function () {
  var chargeType = $('#editDiscountType').val();
  settingWithdrawChargeSymbol(chargeType);
});

function settingWithdrawChargeSymbol(chargeType) {
  $("#editDiscount").trigger("keyup");

  if (chargeType == 1) {
    $('#withdrwalCommissionSymbol').text('Flat');
  } else {
    $('#withdrwalCommissionSymbol').text('%');
  }
}

listenKeyup("#editDiscount", function () {
  var commissionType = $("#editDiscountType").val();
  var commissionValue = $("#editDiscount").val();

  if (commissionType == "2" && commissionValue > 100) {
    $("#editDiscount").val(0);
  }
});

/***/ }),

/***/ "./node_modules/jsrender/jsrender.js":
/*!*******************************************!*\
  !*** ./node_modules/jsrender/jsrender.js ***!
  \*******************************************/
/***/ ((module) => {

/*! JsRender v1.0.11: http://jsviews.com/#jsrender */
/*! **VERSION FOR WEB** (For NODE.JS see http://jsviews.com/download/jsrender-node.js) */
/*
 * Best-of-breed templating in browser or on Node.js.
 * Does not require jQuery, or HTML DOM
 * Integrates with JsViews (http://jsviews.com/#jsviews)
 *
 * Copyright 2021, Boris Moore
 * Released under the MIT License.
 */

//jshint -W018, -W041, -W120

(function(factory, global) {
	// global var is the this object, which is window when running in the usual browser environment
	var $ = global.jQuery;

	if (true) { // CommonJS e.g. Browserify
		module.exports = $
			? factory(global, $)
			: function($) { // If no global jQuery, take optional jQuery passed as parameter: require('jsrender')(jQuery)
				if ($ && !$.fn) {
					throw "Provide jQuery or null";
				}
				return factory(global, $);
			};
	} else {}
} (

// factory (for jsrender.js)
function(global, $) {
"use strict";

//========================== Top-level vars ==========================

// global var is the this object, which is window when running in the usual browser environment
var setGlobals = $ === false; // Only set globals if script block in browser (not AMD and not CommonJS)

$ = $ && $.fn ? $ : global.jQuery; // $ is jQuery passed in by CommonJS loader (Browserify), or global jQuery.

var versionNumber = "v1.0.11",
	jsvStoreName, rTag, rTmplString, topView, $views, $expando,
	_ocp = "_ocp",      // Observable contextual parameter

	$isFunction, $isArray, $templates, $converters, $helpers, $tags, $sub, $subSettings, $subSettingsAdvanced, $viewsSettings,
	delimOpenChar0, delimOpenChar1, delimCloseChar0, delimCloseChar1, linkChar, setting, baseOnError,

	isRenderCall,
	rNewLine = /[ \t]*(\r\n|\n|\r)/g,
	rUnescapeQuotes = /\\(['"\\])/g, // Unescape quotes and trim
	rEscapeQuotes = /['"\\]/g, // Escape quotes and \ character
	rBuildHash = /(?:\x08|^)(onerror:)?(?:(~?)(([\w$.]+):)?([^\x08]+))\x08(,)?([^\x08]+)/gi,
	rTestElseIf = /^if\s/,
	rFirstElem = /<(\w+)[>\s]/,
	rAttrEncode = /[\x00`><"'&=]/g, // Includes > encoding since rConvertMarkers in JsViews does not skip > characters in attribute strings
	rIsHtml = /[\x00`><\"'&=]/,
	rHasHandlers = /^on[A-Z]|^convert(Back)?$/,
	rWrappedInViewMarker = /^\#\d+_`[\s\S]*\/\d+_`$/,
	rHtmlEncode = rAttrEncode,
	rDataEncode = /[&<>]/g,
	rDataUnencode = /&(amp|gt|lt);/g,
	rBracketQuote = /\[['"]?|['"]?\]/g,
	viewId = 0,
	charEntities = {
		"&": "&amp;",
		"<": "&lt;",
		">": "&gt;",
		"\x00": "&#0;",
		"'": "&#39;",
		'"': "&#34;",
		"`": "&#96;",
		"=": "&#61;"
	},
	charsFromEntities = {
		amp: "&",
		gt: ">",
		lt: "<"
	},
	HTML = "html",
	OBJECT = "object",
	tmplAttr = "data-jsv-tmpl",
	jsvTmpl = "jsvTmpl",
	indexStr = "For #index in nested block use #getIndex().",
	cpFnStore = {},     // Compiled furnctions for computed values in template expressions (properties, methods, helpers)
	$render = {},

	jsr = global.jsrender,
	jsrToJq = jsr && $ && !$.render, // JsRender already loaded, without jQuery. but we will re-load it now to attach to jQuery

	jsvStores = {
		template: {
			compile: compileTmpl
		},
		tag: {
			compile: compileTag
		},
		viewModel: {
			compile: compileViewModel
		},
		helper: {},
		converter: {}
	};

	// views object ($.views if jQuery is loaded, jsrender.views if no jQuery, e.g. in Node.js)
	$views = {
		jsviews: versionNumber,
		sub: {
			// subscription, e.g. JsViews integration
			rPath: /^(!*?)(?:null|true|false|\d[\d.]*|([\w$]+|\.|~([\w$]+)|#(view|([\w$]+))?)([\w$.^]*?)(?:[.[^]([\w$]+)\]?)?)$/g,
			//        not                               object     helper    view  viewProperty pathTokens      leafToken

			rPrm: /(\()(?=\s*\()|(?:([([])\s*)?(?:(\^?)(~?[\w$.^]+)?\s*((\+\+|--)|\+|-|~(?![\w$])|&&|\|\||===|!==|==|!=|<=|>=|[<>%*:?\/]|(=))\s*|(!*?(@)?[#~]?[\w$.^]+)([([])?)|(,\s*)|(?:(\()\s*)?\\?(?:(')|("))|(?:\s*(([)\]])(?=[.^]|\s*$|[^([])|[)\]])([([]?))|(\s+)/g,
			//   lftPrn0           lftPrn         bound     path               operator     err                                          eq      path2 late            prn      comma  lftPrn2          apos quot        rtPrn  rtPrnDot                  prn2     space

			View: View,
			Err: JsViewsError,
			tmplFn: tmplFn,
			parse: parseParams,
			extend: $extend,
			extendCtx: extendCtx,
			syntaxErr: syntaxError,
			onStore: {
				template: function(name, item) {
					if (item === null) {
						delete $render[name];
					} else if (name) {
						$render[name] = item;
					}
				}
			},
			addSetting: addSetting,
			settings: {
				allowCode: false
			},
			advSet: noop, // Update advanced settings
			_thp: tagHandlersFromProps,
			_gm: getMethod,
			_tg: function() {}, // Constructor for tagDef
			_cnvt: convertVal,
			_tag: renderTag,
			_er: error,
			_err: onRenderError,
			_cp: retVal, // Get observable contextual parameters (or properties) ~foo=expr. In JsRender, simply returns val.
			_sq: function(token) {
				if (token === "constructor") {
					syntaxError("");
				}
				return token;
			}
		},
		settings: {
			delimiters: $viewsDelimiters,
			advanced: function(value) {
				return value
					? (
							$extend($subSettingsAdvanced, value),
							$sub.advSet(),
							$viewsSettings
						)
						: $subSettingsAdvanced;
				}
		},
		map: dataMap // If jsObservable loaded first, use that definition of dataMap
	};

function getDerivedMethod(baseMethod, method) {
	return function() {
		var ret,
			tag = this,
			prevBase = tag.base;

		tag.base = baseMethod; // Within method call, calling this.base will call the base method
		ret = method.apply(tag, arguments); // Call the method
		tag.base = prevBase; // Replace this.base to be the base method of the previous call, for chained calls
		return ret;
	};
}

function getMethod(baseMethod, method) {
	// For derived methods (or handlers declared declaratively as in {{:foo onChange=~fooChanged}} replace by a derived method, to allow using this.base(...)
	// or this.baseApply(arguments) to call the base implementation. (Equivalent to this._super(...) and this._superApply(arguments) in jQuery UI)
	if ($isFunction(method)) {
		method = getDerivedMethod(
				!baseMethod
					? noop // no base method implementation, so use noop as base method
					: baseMethod._d
						? baseMethod // baseMethod is a derived method, so use it
						: getDerivedMethod(noop, baseMethod), // baseMethod is not derived so make its base method be the noop method
				method
			);
		method._d = (baseMethod && baseMethod._d || 0) + 1; // Add flag for derived method (incremented for derived of derived...)
	}
	return method;
}

function tagHandlersFromProps(tag, tagCtx) {
	var prop,
		props = tagCtx.props;
	for (prop in props) {
		if (rHasHandlers.test(prop) && !(tag[prop] && tag[prop].fix)) { // Don't override handlers with fix expando (used in datepicker and spinner)
			tag[prop] = prop !== "convert" ? getMethod(tag.constructor.prototype[prop], props[prop]) : props[prop];
			// Copy over the onFoo props, convert and convertBack from tagCtx.props to tag (overrides values in tagDef).
			// Note: unsupported scenario: if handlers are dynamically added ^onFoo=expression this will work, but dynamically removing will not work.
		}
	}
}

function retVal(val) {
	return val;
}

function noop() {
	return "";
}

function dbgBreak(val) {
	// Usage examples: {{dbg:...}}, {{:~dbg(...)}}, {{dbg .../}}, {^{for ... onAfterLink=~dbg}} etc.
	try {
		console.log("JsRender dbg breakpoint: " + val);
		throw "dbg breakpoint"; // To break here, stop on caught exceptions.
	}
	catch (e) {}
	return this.base ? this.baseApply(arguments) : val;
}

function JsViewsError(message) {
	// Error exception type for JsViews/JsRender
	// Override of $.views.sub.Error is possible
	this.name = ($.link ? "JsViews" : "JsRender") + " Error";
	this.message = message || this.name;
}

function $extend(target, source) {
	if (target) {
		for (var name in source) {
			target[name] = source[name];
		}
		return target;
	}
}

(JsViewsError.prototype = new Error()).constructor = JsViewsError;

//========================== Top-level functions ==========================

//===================
// views.delimiters
//===================

	/**
	* Set the tag opening and closing delimiters and 'link' character. Default is "{{", "}}" and "^"
	* openChars, closeChars: opening and closing strings, each with two characters
	* $.views.settings.delimiters(...)
	*
	* @param {string}   openChars
	* @param {string}   [closeChars]
	* @param {string}   [link]
	* @returns {Settings}
	*
	* Get delimiters
	* delimsArray = $.views.settings.delimiters()
	*
	* @returns {string[]}
	*/
function $viewsDelimiters(openChars, closeChars, link) {
	if (!openChars) {
		return $subSettings.delimiters;
	}
	if ($isArray(openChars)) {
		return $viewsDelimiters.apply($views, openChars);
	}
	linkChar = link ? link[0] : linkChar;
	if (!/^(\W|_){5}$/.test(openChars + closeChars + linkChar)) {
		error("Invalid delimiters"); // Must be non-word characters, and openChars and closeChars must each be length 2
	}
	delimOpenChar0 = openChars[0];
	delimOpenChar1 = openChars[1];
	delimCloseChar0 = closeChars[0];
	delimCloseChar1 = closeChars[1];

	$subSettings.delimiters = [delimOpenChar0 + delimOpenChar1, delimCloseChar0 + delimCloseChar1, linkChar];

	// Escape the characters - since they could be regex special characters
	openChars = "\\" + delimOpenChar0 + "(\\" + linkChar + ")?\\" + delimOpenChar1; // Default is "{^{"
	closeChars = "\\" + delimCloseChar0 + "\\" + delimCloseChar1;                   // Default is "}}"
	// Build regex with new delimiters
	//          [tag    (followed by / space or })  or cvtr+colon or html or code] followed by space+params then convertBack?
	rTag = "(?:(\\w+(?=[\\/\\s\\" + delimCloseChar0 + "]))|(\\w+)?(:)|(>)|(\\*))\\s*((?:[^\\"
		+ delimCloseChar0 + "]|\\" + delimCloseChar0 + "(?!\\" + delimCloseChar1 + "))*?)";

	// Make rTag available to JsViews (or other components) for parsing binding expressions
	$sub.rTag = "(?:" + rTag + ")";
	//                        { ^? {   tag+params slash?  or closingTag                                                   or comment
	rTag = new RegExp("(?:" + openChars + rTag + "(\\/)?|\\" + delimOpenChar0 + "(\\" + linkChar + ")?\\" + delimOpenChar1 + "(?:(?:\\/(\\w+))\\s*|!--[\\s\\S]*?--))" + closeChars, "g");

	// Default:  bind     tagName         cvt   cln html code    params            slash   bind2         closeBlk  comment
	//      /(?:{(\^)?{(?:(\w+(?=[\/\s}]))|(\w+)?(:)|(>)|(\*))\s*((?:[^}]|}(?!}))*?)(\/)?|{(\^)?{(?:(?:\/(\w+))\s*|!--[\s\S]*?--))}}

	$sub.rTmpl = new RegExp("^\\s|\\s$|<.*>|([^\\\\]|^)[{}]|" + openChars + ".*" + closeChars);
	// $sub.rTmpl looks for initial or final white space, html tags or { or } char not preceded by \\, or JsRender tags {{xxx}}.
	// Each of these strings are considered NOT to be jQuery selectors
	return $viewsSettings;
}

//=========
// View.get
//=========

function getView(inner, type) { //view.get(inner, type)
	if (!type && inner !== true) {
		// view.get(type)
		type = inner;
		inner = undefined;
	}

	var views, i, l, found,
		view = this,
		root = type === "root";
		// view.get("root") returns view.root, view.get() returns view.parent, view.get(true) returns view.views[0].

	if (inner) {
		// Go through views - this one, and all nested ones, depth-first - and return first one with given type.
		// If type is undefined, i.e. view.get(true), return first child view.
		found = type && view.type === type && view;
		if (!found) {
			views = view.views;
			if (view._.useKey) {
				for (i in views) {
					if (found = type ? views[i].get(inner, type) : views[i]) {
						break;
					}
				}
			} else {
				for (i = 0, l = views.length; !found && i < l; i++) {
					found = type ? views[i].get(inner, type) : views[i];
				}
			}
		}
	} else if (root) {
		// Find root view. (view whose parent is top view)
		found = view.root;
	} else if (type) {
		while (view && !found) {
			// Go through views - this one, and all parent ones - and return first one with given type.
			found = view.type === type ? view : undefined;
			view = view.parent;
		}
	} else {
		found = view.parent;
	}
	return found || undefined;
}

function getNestedIndex() {
	var view = this.get("item");
	return view ? view.index : undefined;
}

getNestedIndex.depends = function() {
	return [this.get("item"), "index"];
};

function getIndex() {
	return this.index;
}

getIndex.depends = "index";

//==================
// View.ctxPrm, etc.
//==================

/* Internal private: view._getOb() */
function getPathObject(ob, path, ltOb, fn) {
	// Iterate through path to late paths: @a.b.c paths
	// Return "" (or noop if leaf is a function @a.b.c(...) ) if intermediate object not yet available
	var prevOb, tokens, l,
		i = 0;
	if (ltOb === 1) {
		fn = 1;
		ltOb = undefined;
	}
	// Paths like ^a^b^c or ~^a^b^c will not throw if an object in path is undefined.
	if (path) {
		tokens = path.split(".");
		l = tokens.length;

		for (; ob && i < l; i++) {
			prevOb = ob;
			ob = tokens[i] ? ob[tokens[i]] : ob;
		}
	}
	if (ltOb) {
		ltOb.lt = ltOb.lt || i<l; // If i < l there was an object in the path not yet available
	}
	return ob === undefined
		? fn ? noop : ""
		: fn ? function() {
			return ob.apply(prevOb, arguments);
		} : ob;
}

function contextParameter(key, value, get) {
	// Helper method called as view.ctxPrm(key) for helpers or template parameters ~foo - from compiled template or from context callback
	var wrapped, deps, res, obsCtxPrm, tagElse, callView, newRes,
		storeView = this,
		isUpdate = !isRenderCall && arguments.length > 1,
		store = storeView.ctx;
	if (key) {
		if (!storeView._) { // tagCtx.ctxPrm() call
			tagElse = storeView.index;
			storeView = storeView.tag;
		}
		callView = storeView;
		if (store && store.hasOwnProperty(key) || (store = $helpers).hasOwnProperty(key)) {
			res = store[key];
			if (key === "tag" || key === "tagCtx" || key === "root" || key === "parentTags") {
				return res;
			}
		} else {
			store = undefined;
		}
		if (!isRenderCall && storeView.tagCtx || storeView.linked) { // Data-linked view, or tag instance
			if (!res || !res._cxp) {
				// Not a contextual parameter
				// Set storeView to tag (if this is a tag.ctxPrm() call) or to root view ("data" view of linked template)
				storeView = storeView.tagCtx || $isFunction(res)
					? storeView // Is a tag, not a view, or is a computed contextual parameter, so scope to the callView, no the 'scope view'
					: (storeView = storeView.scope || storeView,
						!storeView.isTop && storeView.ctx.tag // If this view is in a tag, set storeView to the tag
							|| storeView);
				if (res !== undefined && storeView.tagCtx) {
					// If storeView is a tag, but the contextual parameter has been set at at higher level (e.g. helpers)...
					storeView = storeView.tagCtx.view.scope; // then move storeView to the outer level (scope of tag container view)
				}
				store = storeView._ocps;
				res = store && store.hasOwnProperty(key) && store[key] || res;
				if (!(res && res._cxp) && (get || isUpdate)) {
					// Create observable contextual parameter
					(store || (storeView._ocps = storeView._ocps || {}))[key]
						= res
						= [{
							_ocp: res, // The observable contextual parameter value
							_vw: callView,
							_key: key
						}];
					res._cxp = {
						path: _ocp,
						ind: 0,
						updateValue: function(val, path) {
							$.observable(res[0]).setProperty(_ocp, val); // Set the value (res[0]._ocp)
							return this;
						}
					};
				}
			}
			if (obsCtxPrm = res && res._cxp) {
				// If this helper resource is an observable contextual parameter
				if (arguments.length > 2) {
					deps = res[1] ? $sub._ceo(res[1].deps) : [_ocp]; // fn deps (with any exprObs cloned using $sub._ceo)
					deps.unshift(res[0]); // view
					deps._cxp = obsCtxPrm;
					// In a context callback for a contextual param, we set get = true, to get ctxPrm [view, dependencies...] array - needed for observe call
					return deps;
				}
				tagElse = obsCtxPrm.tagElse;
				newRes = res[1] // linkFn for compiled expression
					? obsCtxPrm.tag && obsCtxPrm.tag.cvtArgs
						? obsCtxPrm.tag.cvtArgs(tagElse, 1)[obsCtxPrm.ind] // = tag.bndArgs() - for tag contextual parameter
						: res[1](res[0].data, res[0], $sub) // = fn(data, view, $sub) for compiled binding expression
					: res[0]._ocp; // Observable contextual parameter (uninitialized, or initialized as static expression, so no path dependencies)
				if (isUpdate) {
					$sub._ucp(key, value, storeView, obsCtxPrm); // Update observable contextual parameter
					return storeView;
				}
				res = newRes;
			}
		}
		if (res && $isFunction(res)) {
			// If a helper is of type function we will wrap it, so if called with no this pointer it will be called with the
			// view as 'this' context. If the helper ~foo() was in a data-link expression, the view will have a 'temporary' linkCtx property too.
			// Note that helper functions on deeper paths will have specific this pointers, from the preceding path.
			// For example, ~util.foo() will have the ~util object as 'this' pointer
			wrapped = function() {
				return res.apply((!this || this === global) ? callView : this, arguments);
			};
			$extend(wrapped, res); // Attach same expandos (if any) to the wrapped function
		}
		return wrapped || res;
	}
}

/* Internal private: view._getTmpl() */
function getTemplate(tmpl) {
	return tmpl && (tmpl.fn
		? tmpl
		: this.getRsc("templates", tmpl) || $templates(tmpl)); // not yet compiled
}

//==============
// views._cnvt
//==============

function convertVal(converter, view, tagCtx, onError) {
	// Called from compiled template code for {{:}}
	// self is template object or linkCtx object
	var tag, linkCtx, value, argsLen, bindTo,
		// If tagCtx is an integer, then it is the key for the compiled function to return the boundTag tagCtx
		boundTag = typeof tagCtx === "number" && view.tmpl.bnds[tagCtx-1];

	if (onError === undefined && boundTag && boundTag._lr) { // lateRender
		onError = "";
	}
	if (onError !== undefined) {
		tagCtx = onError = {props: {}, args: [onError]};
	} else if (boundTag) {
		tagCtx = boundTag(view.data, view, $sub);
	}
	boundTag = boundTag._bd && boundTag;
	if (converter || boundTag) {
		linkCtx = view._lc; // For data-link="{cvt:...}"... See onDataLinkedTagChange
		tag = linkCtx && linkCtx.tag;
		tagCtx.view = view;
		if (!tag) {
			tag = $extend(new $sub._tg(), {
				_: {
					bnd: boundTag,
					unlinked: true,
					lt: tagCtx.lt // If a late path @some.path has not returned @some object, mark tag as late
				},
				inline: !linkCtx,
				tagName: ":",
				convert: converter,
				onArrayChange: true,
				flow: true,
				tagCtx: tagCtx,
				tagCtxs: [tagCtx],
				_is: "tag"
			});
			argsLen = tagCtx.args.length;
			if (argsLen>1) {
				bindTo = tag.bindTo = [];
				while (argsLen--) {
					bindTo.unshift(argsLen); // Bind to all the arguments - generate bindTo array: [0,1,2...]
				}
			}
			if (linkCtx) {
				linkCtx.tag = tag;
				tag.linkCtx = linkCtx;
			}
			tagCtx.ctx = extendCtx(tagCtx.ctx, (linkCtx ? linkCtx.view : view).ctx);
			tagHandlersFromProps(tag, tagCtx);
		}
		tag._er = onError && value;
		tag.ctx = tagCtx.ctx || tag.ctx || {};
		tagCtx.ctx = undefined;
		value = tag.cvtArgs()[0]; // If there is a convertBack but no convert, converter will be "true"
		tag._er = onError && value;
	} else {
		value = tagCtx.args[0];
	}

	// Call onRender (used by JsViews if present, to add binding annotations around rendered content)
	value = boundTag && view._.onRender
		? view._.onRender(value, view, tag)
		: value;
	return value != undefined ? value : "";
}

function convertArgs(tagElse, bound) { // tag.cvtArgs() or tag.cvtArgs(tagElse?, true?)
	var l, key, boundArgs, args, bindFrom, tag, converter,
		tagCtx = this;

	if (tagCtx.tagName) {
		tag = tagCtx;
		tagCtx = (tag.tagCtxs || [tagCtx])[tagElse||0];
		if (!tagCtx) {
			return;
		}
	} else {
		tag = tagCtx.tag;
	}

	bindFrom = tag.bindFrom;
	args = tagCtx.args;

	if ((converter = tag.convert) && "" + converter === converter) {
		converter = converter === "true"
			? undefined
			: (tagCtx.view.getRsc("converters", converter) || error("Unknown converter: '" + converter + "'"));
	}

	if (converter && !bound) { // If there is a converter, use a copy of the tagCtx.args array for rendering, and replace the args[0] in
		args = args.slice(); // the copied array with the converted value. But we do not modify the value of tag.tagCtx.args[0] (the original args array)
	}
	if (bindFrom) { // Get the values of the boundArgs
		boundArgs = [];
		l = bindFrom.length;
		while (l--) {
			key = bindFrom[l];
			boundArgs.unshift(argOrProp(tagCtx, key));
		}
		if (bound) {
			args = boundArgs; // Call to bndArgs() - returns the boundArgs
		}
	}
	if (converter) {
		converter = converter.apply(tag, boundArgs || args);
		if (converter === undefined) {
			return args; // Returning undefined from a converter is equivalent to not having a converter.
		}
		bindFrom = bindFrom || [0];
		l = bindFrom.length;
		if (!$isArray(converter) || (converter.arg0 !== false && (l === 1 || converter.length !== l || converter.arg0))) {
			converter = [converter]; // Returning converter as first arg, even if converter value is an array
			bindFrom = [0];
			l = 1;
		}
		if (bound) {        // Call to bndArgs() - so apply converter to all boundArgs
			args = converter; // The array of values returned from the converter
		} else {            // Call to cvtArgs()
			while (l--) {
				key = bindFrom[l];
				if (+key === key) {
					args[key] = converter[l];
				}
			}
		}
	}
	return args;
}

function argOrProp(context, key) {
	context = context[+key === key ? "args" : "props"];
	return context && context[key];
}

function convertBoundArgs(tagElse) { // tag.bndArgs()
	return this.cvtArgs(tagElse, 1);
}

//=============
// views.tag
//=============

/* view.getRsc() */
function getResource(resourceType, itemName) {
	var res, store,
		view = this;
	if ("" + itemName === itemName) {
		while ((res === undefined) && view) {
			store = view.tmpl && view.tmpl[resourceType];
			res = store && store[itemName];
			view = view.parent;
		}
		return res || $views[resourceType][itemName];
	}
}

function renderTag(tagName, parentView, tmpl, tagCtxs, isUpdate, onError) {
	function bindToOrBindFrom(type) {
		var bindArray = tag[type];

		if (bindArray !== undefined) {
			bindArray = $isArray(bindArray) ? bindArray : [bindArray];
			m = bindArray.length;
			while (m--) {
				key = bindArray[m];
				if (!isNaN(parseInt(key))) {
					bindArray[m] = parseInt(key); // Convert "0" to 0, etc.
				}
			}
		}

		return bindArray || [0];
	}

	parentView = parentView || topView;
	var tag, tagDef, template, tags, attr, parentTag, l, m, n, itemRet, tagCtx, tagCtxCtx, ctxPrm, bindTo, bindFrom, initVal,
		content, callInit, mapDef, thisMap, args, bdArgs, props, tagDataMap, contentCtx, key, bindFromLength, bindToLength, linkedElement, defaultCtx,
		i = 0,
		ret = "",
		linkCtx = parentView._lc || false, // For data-link="{myTag...}"... See onDataLinkedTagChange
		ctx = parentView.ctx,
		parentTmpl = tmpl || parentView.tmpl,
		// If tagCtxs is an integer, then it is the key for the compiled function to return the boundTag tagCtxs
		boundTag = typeof tagCtxs === "number" && parentView.tmpl.bnds[tagCtxs-1];

	if (tagName._is === "tag") {
		tag = tagName;
		tagName = tag.tagName;
		tagCtxs = tag.tagCtxs;
		template = tag.template;
	} else {
		tagDef = parentView.getRsc("tags", tagName) || error("Unknown tag: {{" + tagName + "}} ");
		template = tagDef.template;
	}
	if (onError === undefined && boundTag && (boundTag._lr = (tagDef.lateRender && boundTag._lr!== false || boundTag._lr))) {
		onError = ""; // If lateRender, set temporary onError, to skip initial rendering (and render just "")
	}
	if (onError !== undefined) {
		ret += onError;
		tagCtxs = onError = [{props: {}, args: [], params: {props:{}}}];
	} else if (boundTag) {
		tagCtxs = boundTag(parentView.data, parentView, $sub);
	}

	l = tagCtxs.length;
	for (; i < l; i++) {
		tagCtx = tagCtxs[i];
		content = tagCtx.tmpl;
		if (!linkCtx || !linkCtx.tag || i && !linkCtx.tag.inline || tag._er || content && +content===content) {
			// Initialize tagCtx
			// For block tags, tagCtx.tmpl is an integer > 0
			if (content && parentTmpl.tmpls) {
				tagCtx.tmpl = tagCtx.content = parentTmpl.tmpls[content - 1]; // Set the tmpl property to the content of the block tag
			}
			tagCtx.index = i;
			tagCtx.ctxPrm = contextParameter;
			tagCtx.render = renderContent;
			tagCtx.cvtArgs = convertArgs;
			tagCtx.bndArgs = convertBoundArgs;
			tagCtx.view = parentView;
			tagCtx.ctx = extendCtx(extendCtx(tagCtx.ctx, tagDef && tagDef.ctx), ctx); // Clone and extend parentView.ctx
		}
		if (tmpl = tagCtx.props.tmpl) {
			// If the tmpl property is overridden, set the value (when initializing, or, in case of binding: ^tmpl=..., when updating)
			tagCtx.tmpl = parentView._getTmpl(tmpl);
			tagCtx.content = tagCtx.content || tagCtx.tmpl;
		}

		if (!tag) {
			// This will only be hit for initial tagCtx (not for {{else}}) - if the tag instance does not exist yet
			// If the tag has not already been instantiated, we will create a new instance.
			// ~tag will access the tag, even within the rendering of the template content of this tag.
			// From child/descendant tags, can access using ~tag.parent, or ~parentTags.tagName
			tag = new tagDef._ctr();
			callInit = !!tag.init;

			tag.parent = parentTag = ctx && ctx.tag;
			tag.tagCtxs = tagCtxs;

			if (linkCtx) {
				tag.inline = false;
				linkCtx.tag = tag;
			}
			tag.linkCtx = linkCtx;
			if (tag._.bnd = boundTag || linkCtx.fn) {
				// Bound if {^{tag...}} or data-link="{tag...}"
				tag._.ths = tagCtx.params.props["this"]; // Tag has a this=expr binding, to get javascript reference to tag instance
				tag._.lt = tagCtxs.lt; // If a late path @some.path has not returned @some object, mark tag as late
				tag._.arrVws = {};
			} else if (tag.dataBoundOnly) {
				error(tagName + " must be data-bound:\n{^{" + tagName + "}}");
			}
			//TODO better perf for childTags() - keep child tag.tags array, (and remove child, when disposed)
			// tag.tags = [];
		} else if (linkCtx && linkCtx.fn._lr) {
			callInit = !!tag.init;
		}
		tagDataMap = tag.dataMap;

		tagCtx.tag = tag;
		if (tagDataMap && tagCtxs) {
			tagCtx.map = tagCtxs[i].map; // Copy over the compiled map instance from the previous tagCtxs to the refreshed ones
		}
		if (!tag.flow) {
			tagCtxCtx = tagCtx.ctx = tagCtx.ctx || {};

			// tags hash: tag.ctx.tags, merged with parentView.ctx.tags,
			tags = tag.parents = tagCtxCtx.parentTags = ctx && extendCtx(tagCtxCtx.parentTags, ctx.parentTags) || {};
			if (parentTag) {
				tags[parentTag.tagName] = parentTag;
				//TODO better perf for childTags: parentTag.tags.push(tag);
			}
			tags[tag.tagName] = tagCtxCtx.tag = tag;
			tagCtxCtx.tagCtx = tagCtx;
		}
	}
	if (!(tag._er = onError)) {
		tagHandlersFromProps(tag, tagCtxs[0]);
		tag.rendering = {rndr: tag.rendering}; // Provide object for state during render calls to tag and elses. (Used by {{if}} and {{for}}...)
		for (i = 0; i < l; i++) { // Iterate tagCtx for each {{else}} block
			tagCtx = tag.tagCtx = tagCtxs[i];
			props = tagCtx.props;
			tag.ctx = tagCtx.ctx;

			if (!i) {
				if (callInit) {
					tag.init(tagCtx, linkCtx, tag.ctx);
					callInit = undefined;
				}
				if (!tagCtx.args.length && tagCtx.argDefault !== false && tag.argDefault !== false) {
					tagCtx.args = args = [tagCtx.view.data]; // Missing first arg defaults to the current data context
					tagCtx.params.args = ["#data"];
				}

				bindTo = bindToOrBindFrom("bindTo");

				if (tag.bindTo !== undefined) {
					tag.bindTo = bindTo;
				}

				if (tag.bindFrom !== undefined) {
					tag.bindFrom = bindToOrBindFrom("bindFrom");
				} else if (tag.bindTo) {
					tag.bindFrom = tag.bindTo = bindTo;
				}
				bindFrom = tag.bindFrom || bindTo;

				bindToLength = bindTo.length;
				bindFromLength = bindFrom.length;

				if (tag._.bnd && (linkedElement = tag.linkedElement)) {
					tag.linkedElement = linkedElement = $isArray(linkedElement) ? linkedElement: [linkedElement];

					if (bindToLength !== linkedElement.length) {
						error("linkedElement not same length as bindTo");
					}
				}
				if (linkedElement = tag.linkedCtxParam) {
					tag.linkedCtxParam = linkedElement = $isArray(linkedElement) ? linkedElement: [linkedElement];

					if (bindFromLength !== linkedElement.length) {
						error("linkedCtxParam not same length as bindFrom/bindTo");
					}
				}

				if (bindFrom) {
					tag._.fromIndex = {}; // Hash of bindFrom index which has same path value as bindTo index. fromIndex = tag._.fromIndex[toIndex]
					tag._.toIndex = {}; // Hash of bindFrom index which has same path value as bindTo index. fromIndex = tag._.fromIndex[toIndex]
					n = bindFromLength;
					while (n--) {
						key = bindFrom[n];
						m = bindToLength;
						while (m--) {
							if (key === bindTo[m]) {
								tag._.fromIndex[m] = n;
								tag._.toIndex[n] = m;
							}
						}
					}
				}

				if (linkCtx) {
					// Set attr on linkCtx to ensure outputting to the correct target attribute.
					// Setting either linkCtx.attr or this.attr in the init() allows per-instance choice of target attrib.
					linkCtx.attr = tag.attr = linkCtx.attr || tag.attr || linkCtx._dfAt;
				}
				attr = tag.attr;
				tag._.noVws = attr && attr !== HTML;
			}
			args = tag.cvtArgs(i);
			if (tag.linkedCtxParam) {
				bdArgs = tag.cvtArgs(i, 1);
				m = bindFromLength;
				defaultCtx = tag.constructor.prototype.ctx;
				while (m--) {
					if (ctxPrm = tag.linkedCtxParam[m]) {
						key = bindFrom[m];
						initVal = bdArgs[m];
						// Create tag contextual parameter
						tagCtx.ctx[ctxPrm] = $sub._cp(
							defaultCtx && initVal === undefined ? defaultCtx[ctxPrm]: initVal,
							initVal !== undefined && argOrProp(tagCtx.params, key),
							tagCtx.view,
							tag._.bnd && {tag: tag, cvt: tag.convert, ind: m, tagElse: i}
						);
					}
				}
			}
			if ((mapDef = props.dataMap || tagDataMap) && (args.length || props.dataMap)) {
				thisMap = tagCtx.map;
				if (!thisMap || thisMap.src !== args[0] || isUpdate) {
					if (thisMap && thisMap.src) {
						thisMap.unmap(); // only called if observable map - not when only used in JsRender, e.g. by {{props}}
					}
					mapDef.map(args[0], tagCtx, thisMap, !tag._.bnd);
					thisMap = tagCtx.map;
				}
				args = [thisMap.tgt];
			}

			itemRet = undefined;
			if (tag.render) {
				itemRet = tag.render.apply(tag, args);
				if (parentView.linked && itemRet && !rWrappedInViewMarker.test(itemRet)) {
					// When a tag renders content from the render method, with data linking then we need to wrap with view markers, if absent,
					// to provide a contentView for the tag, which will correctly dispose bindings if deleted. The 'tmpl' for this view will
					// be a dumbed-down template which will always return the itemRet string (no matter what the data is). The itemRet string
					// is not compiled as template markup, so can include "{{" or "}}" without triggering syntax errors
					tmpl = { // 'Dumbed-down' template which always renders 'static' itemRet string
						links: []
					};
					tmpl.render = tmpl.fn = function() {
						return itemRet;
					};
					itemRet = renderWithViews(tmpl, parentView.data, undefined, true, parentView, undefined, undefined, tag);
				}
			}
			if (!args.length) {
				args = [parentView]; // no arguments - (e.g. {{else}}) get data context from view.
			}
			if (itemRet === undefined) {
				contentCtx = args[0]; // Default data context for wrapped block content is the first argument
				if (tag.contentCtx) { // Set tag.contentCtx to true, to inherit parent context, or to a function to provide alternate context.
					contentCtx = tag.contentCtx === true ? parentView : tag.contentCtx(contentCtx);
				}
				itemRet = tagCtx.render(contentCtx, true) || (isUpdate ? undefined : "");
			}
			ret = ret
				? ret + (itemRet || "")
				: itemRet !== undefined
					? "" + itemRet
					: undefined; // If no return value from render, and no template/content tagCtx.render(...), return undefined
		}
		tag.rendering = tag.rendering.rndr; // Remove tag.rendering object (if this is outermost render call. (In case of nested calls)
	}
	tag.tagCtx = tagCtxs[0];
	tag.ctx = tag.tagCtx.ctx;

	if (tag._.noVws && tag.inline) {
		// inline tag with attr set to "text" will insert HTML-encoded content - as if it was element-based innerText
		ret = attr === "text"
			? $converters.html(ret)
			: "";
	}
	return boundTag && parentView._.onRender
		// Call onRender (used by JsViews if present, to add binding annotations around rendered content)
		? parentView._.onRender(ret, parentView, tag)
		: ret;
}

//=================
// View constructor
//=================

function View(context, type, parentView, data, template, key, onRender, contentTmpl) {
	// Constructor for view object in view hierarchy. (Augmented by JsViews if JsViews is loaded)
	var views, parentView_, tag, self_,
		self = this,
		isArray = type === "array";
		// If the data is an array, this is an 'array view' with a views array for each child 'item view'
		// If the data is not an array, this is an 'item view' with a views 'hash' object for any child nested views

	self.content = contentTmpl;
	self.views = isArray ? [] : {};
	self.data = data;
	self.tmpl = template;
	self_ = self._ = {
		key: 0,
		// ._.useKey is non zero if is not an 'array view' (owning a data array). Use this as next key for adding to child views hash
		useKey: isArray ? 0 : 1,
		id: "" + viewId++,
		onRender: onRender,
		bnds: {}
	};
	self.linked = !!onRender;
	self.type = type || "top";
	if (type) {
		self.cache = {_ct: $subSettings._cchCt}; // Used for caching results of computed properties and helpers (view.getCache)
	}

	if (!parentView || parentView.type === "top") {
		(self.ctx = context || {}).root = self.data;
	}

	if (self.parent = parentView) {
		self.root = parentView.root || self; // view whose parent is top view
		views = parentView.views;
		parentView_ = parentView._;
		self.isTop = parentView_.scp; // Is top content view of a link("#container", ...) call
		self.scope = (!context.tag || context.tag === parentView.ctx.tag) && !self.isTop && parentView.scope || self;
		// Scope for contextParams - closest non flow tag ancestor or root view
		if (parentView_.useKey) {
			// Parent is not an 'array view'. Add this view to its views object
			// self._key = is the key in the parent view hash
			views[self_.key = "_" + parentView_.useKey++] = self;
			self.index = indexStr;
			self.getIndex = getNestedIndex;
		} else if (views.length === (self_.key = self.index = key)) { // Parent is an 'array view'. Add this view to its views array
			views.push(self); // Adding to end of views array. (Using push when possible - better perf than splice)
		} else {
			views.splice(key, 0, self); // Inserting in views array
		}
		// If no context was passed in, use parent context
		// If context was passed in, it should have been merged already with parent context
		self.ctx = context || parentView.ctx;
	} else if (type) {
		self.root = self; // view whose parent is top view
	}
}

View.prototype = {
	get: getView,
	getIndex: getIndex,
	ctxPrm: contextParameter,
	getRsc: getResource,
	_getTmpl: getTemplate,
	_getOb: getPathObject,
	getCache: function(key) { // Get cached value of computed value
		if ($subSettings._cchCt > this.cache._ct) {
			this.cache = {_ct: $subSettings._cchCt};
		}
		return this.cache[key] !== undefined ? this.cache[key] : (this.cache[key] = cpFnStore[key](this.data, this, $sub));
	},
	_is: "view"
};

//====================================================
// Registration
//====================================================

function compileChildResources(parentTmpl) {
	var storeName, storeNames, resources;
	for (storeName in jsvStores) {
		storeNames = storeName + "s";
		if (parentTmpl[storeNames]) {
			resources = parentTmpl[storeNames];        // Resources not yet compiled
			parentTmpl[storeNames] = {};               // Remove uncompiled resources
			$views[storeNames](resources, parentTmpl); // Add back in the compiled resources
		}
	}
}

//===============
// compileTag
//===============

function compileTag(name, tagDef, parentTmpl) {
	var tmpl, baseTag, prop,
		compiledDef = new $sub._tg();

	function Tag() {
		var tag = this;
		tag._ = {
			unlinked: true
		};
		tag.inline = true;
		tag.tagName = name;
	}

	if ($isFunction(tagDef)) {
		// Simple tag declared as function. No presenter instantation.
		tagDef = {
			depends: tagDef.depends,
			render: tagDef
		};
	} else if ("" + tagDef === tagDef) {
		tagDef = {template: tagDef};
	}

	if (baseTag = tagDef.baseTag) {
		tagDef.flow = !!tagDef.flow; // Set flow property, so defaults to false even if baseTag has flow=true
		baseTag = "" + baseTag === baseTag
			? (parentTmpl && parentTmpl.tags[baseTag] || $tags[baseTag])
			: baseTag;
		if (!baseTag) {
			error('baseTag: "' + tagDef.baseTag + '" not found');
		}
		compiledDef = $extend(compiledDef, baseTag);

		for (prop in tagDef) {
			compiledDef[prop] = getMethod(baseTag[prop], tagDef[prop]);
		}
	} else {
		compiledDef = $extend(compiledDef, tagDef);
	}

	// Tag declared as object, used as the prototype for tag instantiation (control/presenter)
	if ((tmpl = compiledDef.template) !== undefined) {
		compiledDef.template = "" + tmpl === tmpl ? ($templates[tmpl] || $templates(tmpl)) : tmpl;
	}
	(Tag.prototype = compiledDef).constructor = compiledDef._ctr = Tag;

	if (parentTmpl) {
		compiledDef._parentTmpl = parentTmpl;
	}
	return compiledDef;
}

function baseApply(args) {
	// In derived method (or handler declared declaratively as in {{:foo onChange=~fooChanged}} can call base method,
	// using this.baseApply(arguments) (Equivalent to this._superApply(arguments) in jQuery UI)
	return this.base.apply(this, args);
}

//===============
// compileTmpl
//===============

function compileTmpl(name, tmpl, parentTmpl, options) {
	// tmpl is either a template object, a selector for a template script block, or the name of a compiled template

	//==== nested functions ====
	function lookupTemplate(value) {
		// If value is of type string - treat as selector, or name of compiled template
		// Return the template object, if already compiled, or the markup string
		var currentName, tmpl;
		if (("" + value === value) || value.nodeType > 0 && (elem = value)) {
			if (!elem) {
				if (/^\.?\/[^\\:*?"<>]*$/.test(value)) {
					// value="./some/file.html" (or "/some/file.html")
					// If the template is not named, use "./some/file.html" as name.
					if (tmpl = $templates[name = name || value]) {
						value = tmpl;
					} else {
						// BROWSER-SPECIFIC CODE (not on Node.js):
						// Look for server-generated script block with id "./some/file.html"
						elem = document.getElementById(value);
					}
				} else if (value.charAt(0) === "#") {
					elem = document.getElementById(value.slice(1));
				} else if ($.fn && !$sub.rTmpl.test(value)) {
					try {
						elem = $(value, document)[0]; // if jQuery is loaded, test for selector returning elements, and get first element
					} catch (e) {}
				}// END BROWSER-SPECIFIC CODE
			} //BROWSER-SPECIFIC CODE
			if (elem) {
				if (elem.tagName !== "SCRIPT") {
					error(value + ": Use script block, not " + elem.tagName);
				}
				if (options) {
					// We will compile a new template using the markup in the script element
					value = elem.innerHTML;
				} else {
					// We will cache a single copy of the compiled template, and associate it with the name
					// (renaming from a previous name if there was one).
					currentName = elem.getAttribute(tmplAttr);
					if (currentName) {
						if (currentName !== jsvTmpl) {
							value = $templates[currentName];
							delete $templates[currentName];
						} else if ($.fn) {
							value = $.data(elem)[jsvTmpl]; // Get cached compiled template
						}
					}
					if (!currentName || !value) { // Not yet compiled, or cached version lost
						name = name || ($.fn ? jsvTmpl : value);
						value = compileTmpl(name, elem.innerHTML, parentTmpl, options);
					}
					value.tmplName = name = name || currentName;
					if (name !== jsvTmpl) {
						$templates[name] = value;
					}
					elem.setAttribute(tmplAttr, name);
					if ($.fn) {
						$.data(elem, jsvTmpl, value);
					}
				}
			} // END BROWSER-SPECIFIC CODE
			elem = undefined;
		} else if (!value.fn) {
			value = undefined;
			// If value is not a string. HTML element, or compiled template, return undefined
		}
		return value;
	}

	var elem, compiledTmpl,
		tmplOrMarkup = tmpl = tmpl || "";
	$sub._html = $converters.html;

	//==== Compile the template ====
	if (options === 0) {
		options = undefined;
		tmplOrMarkup = lookupTemplate(tmplOrMarkup); // Top-level compile so do a template lookup
	}

	// If options, then this was already compiled from a (script) element template declaration.
	// If not, then if tmpl is a template object, use it for options
	options = options || (tmpl.markup
		? tmpl.bnds
			? $extend({}, tmpl)
			: tmpl
		: {}
	);

	options.tmplName = options.tmplName || name || "unnamed";
	if (parentTmpl) {
		options._parentTmpl = parentTmpl;
	}
	// If tmpl is not a markup string or a selector string, then it must be a template object
	// In that case, get it from the markup property of the object
	if (!tmplOrMarkup && tmpl.markup && (tmplOrMarkup = lookupTemplate(tmpl.markup)) && tmplOrMarkup.fn) {
		// If the string references a compiled template object, need to recompile to merge any modified options
		tmplOrMarkup = tmplOrMarkup.markup;
	}
	if (tmplOrMarkup !== undefined) {
		if (tmplOrMarkup.render || tmpl.render) {
			// tmpl is already compiled, so use it
			if (tmplOrMarkup.tmpls) {
				compiledTmpl = tmplOrMarkup;
			}
		} else {
			// tmplOrMarkup is a markup string, not a compiled template
			// Create template object
			tmpl = tmplObject(tmplOrMarkup, options);
			// Compile to AST and then to compiled function
			tmplFn(tmplOrMarkup.replace(rEscapeQuotes, "\\$&"), tmpl);
		}
		if (!compiledTmpl) {
			compiledTmpl = $extend(function() {
				return compiledTmpl.render.apply(compiledTmpl, arguments);
			}, tmpl);

			compileChildResources(compiledTmpl);
		}
		return compiledTmpl;
	}
}

//==== /end of function compileTmpl ====

//=================
// compileViewModel
//=================

function getDefaultVal(defaultVal, data) {
	return $isFunction(defaultVal)
		? defaultVal.call(data)
		: defaultVal;
}

function addParentRef(ob, ref, parent) {
	Object.defineProperty(ob, ref, {
		value: parent,
		configurable: true
	});
}

function compileViewModel(name, type) {
	var i, constructor, parent,
		viewModels = this,
		getters = type.getters,
		extend = type.extend,
		id = type.id,
		proto = $.extend({
			_is: name || "unnamed",
			unmap: unmap,
			merge: merge
		}, extend),
		args = "",
		cnstr = "",
		getterCount = getters ? getters.length : 0,
		$observable = $.observable,
		getterNames = {};

	function JsvVm(args) {
		constructor.apply(this, args);
	}

	function vm() {
		return new JsvVm(arguments);
	}

	function iterate(data, action) {
		var getterType, defaultVal, prop, ob, parentRef,
			j = 0;
		for (; j < getterCount; j++) {
			prop = getters[j];
			getterType = undefined;
			if (prop + "" !== prop) {
				getterType = prop;
				prop = getterType.getter;
				parentRef = getterType.parentRef;
			}
			if ((ob = data[prop]) === undefined && getterType && (defaultVal = getterType.defaultVal) !== undefined) {
				ob = getDefaultVal(defaultVal, data);
			}
			action(ob, getterType && viewModels[getterType.type], prop, parentRef);
		}
	}

	function map(data) {
		data = data + "" === data
			? JSON.parse(data) // Accept JSON string
			: data;            // or object/array
		var l, prop, childOb, parentRef,
			j = 0,
			ob = data,
			arr = [];

		if ($isArray(data)) {
			data = data || [];
			l = data.length;
			for (; j<l; j++) {
				arr.push(this.map(data[j]));
			}
			arr._is = name;
			arr.unmap = unmap;
			arr.merge = merge;
			return arr;
		}

		if (data) {
			iterate(data, function(ob, viewModel) {
				if (viewModel) { // Iterate to build getters arg array (value, or mapped value)
					ob = viewModel.map(ob);
				}
				arr.push(ob);
			});
			ob = this.apply(this, arr); // Instantiate this View Model, passing getters args array to constructor
			j = getterCount;
			while (j--) {
				childOb = arr[j];
				parentRef = getters[j].parentRef;
				if (parentRef && childOb && childOb.unmap) {
					if ($isArray(childOb)) {
						l = childOb.length;
						while (l--) {
							addParentRef(childOb[l], parentRef, ob);
						}
					} else {
						addParentRef(childOb, parentRef, ob);
					}
				}
			}
			for (prop in data) { // Copy over any other properties. that are not get/set properties
				if (prop !== $expando && !getterNames[prop]) {
					ob[prop] = data[prop];
				}
			}
		}
		return ob;
	}

	function merge(data, parent, parentRef) {
		data = data + "" === data
			? JSON.parse(data) // Accept JSON string
			: data;            // or object/array

		var j, l, m, prop, mod, found, assigned, ob, newModArr, childOb,
			k = 0,
			model = this;

		if ($isArray(model)) {
			assigned = {};
			newModArr = [];
			l = data.length;
			m = model.length;
			for (; k<l; k++) {
				ob = data[k];
				found = false;
				for (j=0; j<m && !found; j++) {
					if (assigned[j]) {
						continue;
					}
					mod = model[j];

					if (id) {
						assigned[j] = found = id + "" === id
						? (ob[id] && (getterNames[id] ? mod[id]() : mod[id]) === ob[id])
						: id(mod, ob);
					}
				}
				if (found) {
					mod.merge(ob);
					newModArr.push(mod);
				} else {
					newModArr.push(childOb = vm.map(ob));
					if (parentRef) {
						addParentRef(childOb, parentRef, parent);
					}
				}
			}
			if ($observable) {
				$observable(model).refresh(newModArr, true);
			} else {
				model.splice.apply(model, [0, model.length].concat(newModArr));
			}
			return;
		}
		iterate(data, function(ob, viewModel, getter, parentRef) {
			if (viewModel) {
				model[getter]().merge(ob, model, parentRef); // Update typed property
			} else if (model[getter]() !== ob) {
				model[getter](ob); // Update non-typed property
			}
		});
		for (prop in data) {
			if (prop !== $expando && !getterNames[prop]) {
				model[prop] = data[prop];
			}
		}
	}

	function unmap() {
		var ob, prop, getterType, arr, value,
			k = 0,
			model = this;

		function unmapArray(modelArr) {
			var arr = [],
				i = 0,
				l = modelArr.length;
			for (; i<l; i++) {
				arr.push(modelArr[i].unmap());
			}
			return arr;
		}

		if ($isArray(model)) {
			return unmapArray(model);
		}
		ob = {};
		for (; k < getterCount; k++) {
			prop = getters[k];
			getterType = undefined;
			if (prop + "" !== prop) {
				getterType = prop;
				prop = getterType.getter;
			}
			value = model[prop]();
			ob[prop] = getterType && value && viewModels[getterType.type]
				? $isArray(value)
					? unmapArray(value)
					: value.unmap()
				: value;
		}
		for (prop in model) {
			if (model.hasOwnProperty(prop) && (prop.charAt(0) !== "_" || !getterNames[prop.slice(1)]) && prop !== $expando && !$isFunction(model[prop])) {
				ob[prop] = model[prop];
			}
		}
		return ob;
	}

	JsvVm.prototype = proto;

	for (i=0; i < getterCount; i++) {
		(function(getter) {
			getter = getter.getter || getter;
			getterNames[getter] = i+1;
			var privField = "_" + getter;

			args += (args ? "," : "") + getter;
			cnstr += "this." + privField + " = " + getter + ";\n";
			proto[getter] = proto[getter] || function(val) {
				if (!arguments.length) {
					return this[privField]; // If there is no argument, use as a getter
				}
				if ($observable) {
					$observable(this).setProperty(getter, val);
				} else {
					this[privField] = val;
				}
			};

			if ($observable) {
				proto[getter].set = proto[getter].set || function(val) {
					this[privField] = val; // Setter called by observable property change
				};
			}
		})(getters[i]);
	}

	// Constructor for new viewModel instance.
	cnstr = new Function(args, cnstr);

	constructor = function() {
		cnstr.apply(this, arguments);
		// Pass additional parentRef str and parent obj to have a parentRef pointer on instance
		if (parent = arguments[getterCount + 1]) {
			addParentRef(this, arguments[getterCount], parent);
		}
	};

	constructor.prototype = proto;
	proto.constructor = constructor;

	vm.map = map;
	vm.getters = getters;
	vm.extend = extend;
	vm.id = id;
	return vm;
}

function tmplObject(markup, options) {
	// Template object constructor
	var htmlTag,
		wrapMap = $subSettingsAdvanced._wm || {}, // Only used in JsViews. Otherwise empty: {}
		tmpl = {
			tmpls: [],
			links: {}, // Compiled functions for link expressions
			bnds: [],
			_is: "template",
			render: renderContent
		};

	if (options) {
		tmpl = $extend(tmpl, options);
	}

	tmpl.markup = markup;
	if (!tmpl.htmlTag) {
		// Set tmpl.tag to the top-level HTML tag used in the template, if any...
		htmlTag = rFirstElem.exec(markup);
		tmpl.htmlTag = htmlTag ? htmlTag[1].toLowerCase() : "";
	}
	htmlTag = wrapMap[tmpl.htmlTag];
	if (htmlTag && htmlTag !== wrapMap.div) {
		// When using JsViews, we trim templates which are inserted into HTML contexts where text nodes are not rendered (i.e. not 'Phrasing Content').
		// Currently not trimmed for <li> tag. (Not worth adding perf cost)
		tmpl.markup = $.trim(tmpl.markup);
	}

	return tmpl;
}

//==============
// registerStore
//==============

/**
* Internal. Register a store type (used for template, tags, helpers, converters)
*/
function registerStore(storeName, storeSettings) {

/**
* Generic store() function to register item, named item, or hash of items
* Also used as hash to store the registered items
* Used as implementation of $.templates(), $.views.templates(), $.views.tags(), $.views.helpers() and $.views.converters()
*
* @param {string|hash} name         name - or selector, in case of $.templates(). Or hash of items
* @param {any}         [item]       (e.g. markup for named template)
* @param {template}    [parentTmpl] For item being registered as private resource of template
* @returns {any|$.views} item, e.g. compiled template - or $.views in case of registering hash of items
*/
	function theStore(name, item, parentTmpl) {
		// The store is also the function used to add items to the store. e.g. $.templates, or $.views.tags

		// For store of name 'thing', Call as:
		//    $.views.things(items[, parentTmpl]),
		// or $.views.things(name[, item, parentTmpl])

		var compile, itemName, thisStore, cnt,
			onStore = $sub.onStore[storeName];

		if (name && typeof name === OBJECT && !name.nodeType && !name.markup && !name.getTgt && !(storeName === "viewModel" && name.getters || name.extend)) {
			// Call to $.views.things(items[, parentTmpl]),

			// Adding items to the store
			// If name is a hash, then item is parentTmpl. Iterate over hash and call store for key.
			for (itemName in name) {
				theStore(itemName, name[itemName], item);
			}
			return item || $views;
		}
		// Adding a single unnamed item to the store
		if (name && "" + name !== name) { // name must be a string
			parentTmpl = item;
			item = name;
			name = undefined;
		}
		thisStore = parentTmpl
			? storeName === "viewModel"
				? parentTmpl
				: (parentTmpl[storeNames] = parentTmpl[storeNames] || {})
			: theStore;
		compile = storeSettings.compile;

		if (item === undefined) {
			item = compile ? name : thisStore[name];
			name = undefined;
		}
		if (item === null) {
			// If item is null, delete this entry
			if (name) {
				delete thisStore[name];
			}
		} else {
			if (compile) {
				item = compile.call(thisStore, name, item, parentTmpl, 0) || {};
				item._is = storeName; // Only do this for compiled objects (tags, templates...)
			}
			if (name) {
				thisStore[name] = item;
			}
		}
		if (onStore) {
			// e.g. JsViews integration
			onStore(name, item, parentTmpl, compile);
		}
		return item;
	}

	var storeNames = storeName + "s";
	$views[storeNames] = theStore;
}

/**
* Add settings such as:
* $.views.settings.allowCode(true)
* @param {boolean} value
* @returns {Settings}
*
* allowCode = $.views.settings.allowCode()
* @returns {boolean}
*/
function addSetting(st) {
	$viewsSettings[st] = $viewsSettings[st] || function(value) {
		return arguments.length
			? ($subSettings[st] = value, $viewsSettings)
			: $subSettings[st];
	};
}

//========================
// dataMap for render only
//========================

function dataMap(mapDef) {
	function Map(source, options) {
		this.tgt = mapDef.getTgt(source, options);
		options.map = this;
	}

	if ($isFunction(mapDef)) {
		// Simple map declared as function
		mapDef = {
			getTgt: mapDef
		};
	}

	if (mapDef.baseMap) {
		mapDef = $extend($extend({}, mapDef.baseMap), mapDef);
	}

	mapDef.map = function(source, options) {
		return new Map(source, options);
	};
	return mapDef;
}

//==============
// renderContent
//==============

/** Render the template as a string, using the specified data and helpers/context
* $("#tmpl").render(), tmpl.render(), tagCtx.render(), $.render.namedTmpl()
*
* @param {any}        data
* @param {hash}       [context]           helpers or context
* @param {boolean}    [noIteration]
* @param {View}       [parentView]        internal
* @param {string}     [key]               internal
* @param {function}   [onRender]          internal
* @returns {string}   rendered template   internal
*/
function renderContent(data, context, noIteration, parentView, key, onRender) {
	var i, l, tag, tmpl, tagCtx, isTopRenderCall, prevData, prevIndex,
		view = parentView,
		result = "";

	if (context === true) {
		noIteration = context; // passing boolean as second param - noIteration
		context = undefined;
	} else if (typeof context !== OBJECT) {
		context = undefined; // context must be a boolean (noIteration) or a plain object
	}

	if (tag = this.tag) {
		// This is a call from renderTag or tagCtx.render(...)
		tagCtx = this;
		view = view || tagCtx.view;
		tmpl = view._getTmpl(tag.template || tagCtx.tmpl);
		if (!arguments.length) {
			data = tag.contentCtx && $isFunction(tag.contentCtx)
				? data = tag.contentCtx(data)
				: view; // Default data context for wrapped block content is the first argument
		}
	} else {
		// This is a template.render(...) call
		tmpl = this;
	}

	if (tmpl) {
		if (!parentView && data && data._is === "view") {
			view = data; // When passing in a view to render or link (and not passing in a parent view) use the passed-in view as parentView
		}

		if (view && data === view) {
			// Inherit the data from the parent view.
			data = view.data;
		}

		isTopRenderCall = !view;
		isRenderCall = isRenderCall || isTopRenderCall;
		if (isTopRenderCall) {
			(context = context || {}).root = data; // Provide ~root as shortcut to top-level data.
		}
		if (!isRenderCall || $subSettingsAdvanced.useViews || tmpl.useViews || view && view !== topView) {
			result = renderWithViews(tmpl, data, context, noIteration, view, key, onRender, tag);
		} else {
			if (view) { // In a block
				prevData = view.data;
				prevIndex = view.index;
				view.index = indexStr;
			} else {
				view = topView;
				prevData = view.data;
				view.data = data;
				view.ctx = context;
			}
			if ($isArray(data) && !noIteration) {
				// Create a view for the array, whose child views correspond to each data item. (Note: if key and parentView are passed in
				// along with parent view, treat as insert -e.g. from view.addViews - so parentView is already the view item for array)
				for (i = 0, l = data.length; i < l; i++) {
					view.index = i;
					view.data = data[i];
					result += tmpl.fn(data[i], view, $sub);
				}
			} else {
				view.data = data;
				result += tmpl.fn(data, view, $sub);
			}
			view.data = prevData;
			view.index = prevIndex;
		}
		if (isTopRenderCall) {
			isRenderCall = undefined;
		}
	}
	return result;
}

function renderWithViews(tmpl, data, context, noIteration, view, key, onRender, tag) {
	// Render template against data as a tree of subviews (nested rendered template instances), or as a string (top-level template).
	// If the data is the parent view, treat as noIteration, re-render with the same data context.
	// tmpl can be a string (e.g. rendered by a tag.render() method), or a compiled template.
	var i, l, newView, childView, itemResult, swapContent, contentTmpl, outerOnRender, tmplName, itemVar, newCtx, tagCtx, noLinking,
		result = "";

	if (tag) {
		// This is a call from renderTag or tagCtx.render(...)
		tmplName = tag.tagName;
		tagCtx = tag.tagCtx;
		context = context ? extendCtx(context, tag.ctx) : tag.ctx;

		if (tmpl === view.content) { // {{xxx tmpl=#content}}
			contentTmpl = tmpl !== view.ctx._wrp // We are rendering the #content
				? view.ctx._wrp // #content was the tagCtx.props.tmpl wrapper of the block content - so within this view, #content will now be the view.ctx._wrp block content
				: undefined; // #content was the view.ctx._wrp block content - so within this view, there is no longer any #content to wrap.
		} else if (tmpl !== tagCtx.content) {
			if (tmpl === tag.template) { // Rendering {{tag}} tag.template, replacing block content.
				contentTmpl = tagCtx.tmpl; // Set #content to block content (or wrapped block content if tagCtx.props.tmpl is set)
				context._wrp = tagCtx.content; // Pass wrapped block content to nested views
			} else { // Rendering tagCtx.props.tmpl wrapper
				contentTmpl = tagCtx.content || view.content; // Set #content to wrapped block content
			}
		} else {
			contentTmpl = view.content; // Nested views inherit same wrapped #content property
		}

		if (tagCtx.props.link === false) {
			// link=false setting on block tag
			// We will override inherited value of link by the explicit setting link=false taken from props
			// The child views of an unlinked view are also unlinked. So setting child back to true will not have any effect.
			context = context || {};
			context.link = false;
		}
	}

	if (view) {
		onRender = onRender || view._.onRender;
		noLinking = context && context.link === false;

		if (noLinking && view._.nl) {
			onRender = undefined;
		}

		context = extendCtx(context, view.ctx);
		tagCtx = !tag && view.tag
			? view.tag.tagCtxs[view.tagElse]
			: tagCtx;
	}

	if (itemVar = tagCtx && tagCtx.props.itemVar) {
		if (itemVar[0] !== "~") {
			syntaxError("Use itemVar='~myItem'");
		}
		itemVar = itemVar.slice(1);
	}

	if (key === true) {
		swapContent = true;
		key = 0;
	}

	// If link===false, do not call onRender, so no data-linking marker nodes
	if (onRender && tag && tag._.noVws) {
		onRender = undefined;
	}
	outerOnRender = onRender;
	if (onRender === true) {
		// Used by view.refresh(). Don't create a new wrapper view.
		outerOnRender = undefined;
		onRender = view._.onRender;
	}
	// Set additional context on views created here, (as modified context inherited from the parent, and to be inherited by child views)
	context = tmpl.helpers
		? extendCtx(tmpl.helpers, context)
		: context;

	newCtx = context;
	if ($isArray(data) && !noIteration) {
		// Create a view for the array, whose child views correspond to each data item. (Note: if key and view are passed in
		// along with parent view, treat as insert -e.g. from view.addViews - so view is already the view item for array)
		newView = swapContent
			? view
			: (key !== undefined && view)
				|| new View(context, "array", view, data, tmpl, key, onRender, contentTmpl);
		newView._.nl= noLinking;
		if (view && view._.useKey) {
			// Parent is not an 'array view'
			newView._.bnd = !tag || tag._.bnd && tag; // For array views that are data bound for collection change events, set the
			// view._.bnd property to true for top-level link() or data-link="{for}", or to the tag instance for a data-bound tag, e.g. {^{for ...}}
			newView.tag = tag;
		}
		for (i = 0, l = data.length; i < l; i++) {
			// Create a view for each data item.
			childView = new View(newCtx, "item", newView, data[i], tmpl, (key || 0) + i, onRender, newView.content);
			if (itemVar) {
				(childView.ctx = $extend({}, newCtx))[itemVar] = $sub._cp(data[i], "#data", childView);
			}
			itemResult = tmpl.fn(data[i], childView, $sub);
			result += newView._.onRender ? newView._.onRender(itemResult, childView) : itemResult;
		}
	} else {
		// Create a view for singleton data object. The type of the view will be the tag name, e.g. "if" or "mytag" except for
		// "item", "array" and "data" views. A "data" view is from programmatic render(object) against a 'singleton'.
		newView = swapContent ? view : new View(newCtx, tmplName || "data", view, data, tmpl, key, onRender, contentTmpl);

		if (itemVar) {
			(newView.ctx = $extend({}, newCtx))[itemVar] = $sub._cp(data, "#data", newView);
		}

		newView.tag = tag;
		newView._.nl = noLinking;
		result += tmpl.fn(data, newView, $sub);
	}
	if (tag) {
		newView.tagElse = tagCtx.index;
		tagCtx.contentView = newView;
	}
	return outerOnRender ? outerOnRender(result, newView) : result;
}

//===========================
// Build and compile template
//===========================

// Generate a reusable function that will serve to render a template against data
// (Compile AST then build template function)

function onRenderError(e, view, fallback) {
	var message = fallback !== undefined
		? $isFunction(fallback)
			? fallback.call(view.data, e, view)
			: fallback || ""
		: "{Error: " + (e.message||e) + "}";

	if ($subSettings.onError && (fallback = $subSettings.onError.call(view.data, e, fallback && message, view)) !== undefined) {
		message = fallback; // There is a settings.debugMode(handler) onError override. Call it, and use return value (if any) to replace message
	}
	return view && !view._lc ? $converters.html(message) : message; // For data-link=\"{... onError=...}"... See onDataLinkedTagChange
}

function error(message) {
	throw new $sub.Err(message);
}

function syntaxError(message) {
	error("Syntax error\n" + message);
}

function tmplFn(markup, tmpl, isLinkExpr, convertBack, hasElse) {
	// Compile markup to AST (abtract syntax tree) then build the template function code from the AST nodes
	// Used for compiling templates, and also by JsViews to build functions for data link expressions

	//==== nested functions ====
	function pushprecedingContent(shift) {
		shift -= loc;
		if (shift) {
			content.push(markup.substr(loc, shift).replace(rNewLine, "\\n"));
		}
	}

	function blockTagCheck(tagName, block) {
		if (tagName) {
			tagName += '}}';
			//			'{{include}} block has {{/for}} with no open {{for}}'
			syntaxError((
				block
					? '{{' + block + '}} block has {{/' + tagName + ' without {{' + tagName
					: 'Unmatched or missing {{/' + tagName) + ', in template:\n' + markup);
		}
	}

	function parseTag(all, bind, tagName, converter, colon, html, codeTag, params, slash, bind2, closeBlock, index) {
/*

     bind     tagName         cvt   cln html code    params            slash   bind2         closeBlk  comment
/(?:{(\^)?{(?:(\w+(?=[\/\s}]))|(\w+)?(:)|(>)|(\*))\s*((?:[^}]|}(?!}))*?)(\/)?|{(\^)?{(?:(?:\/(\w+))\s*|!--[\s\S]*?--))}}/g

(?:
  {(\^)?{            bind
  (?:
    (\w+             tagName
      (?=[\/\s}])
    )
    |
    (\w+)?(:)        converter colon
    |
    (>)              html
    |
    (\*)             codeTag
  )
  \s*
  (                  params
    (?:[^}]|}(?!}))*?
  )
  (\/)?              slash
  |
  {(\^)?{            bind2
  (?:
    (?:\/(\w+))\s*   closeBlock
    |
    !--[\s\S]*?--    comment
  )
)
}}/g

*/
		if (codeTag && bind || slash && !tagName || params && params.slice(-1) === ":" || bind2) {
			syntaxError(all);
		}

		// Build abstract syntax tree (AST): [tagName, converter, params, content, hash, bindings, contentMarkup]
		if (html) {
			colon = ":";
			converter = HTML;
		}
		slash = slash || isLinkExpr && !hasElse;

		var late, openTagName, isLateOb,
			pathBindings = (bind || isLinkExpr) && [[]], // pathBindings is an array of arrays for arg bindings and a hash of arrays for prop bindings
			props = "",
			args = "",
			ctxProps = "",
			paramsArgs = "",
			paramsProps = "",
			paramsCtxProps = "",
			onError = "",
			useTrigger = "",
			// Block tag if not self-closing and not {{:}} or {{>}} (special case) and not a data-link expression
			block = !slash && !colon;

		//==== nested helper function ====
		tagName = tagName || (params = params || "#data", colon); // {{:}} is equivalent to {{:#data}}
		pushprecedingContent(index);
		loc = index + all.length; // location marker - parsed up to here
		if (codeTag) {
			if (allowCode) {
				content.push(["*", "\n" + params.replace(/^:/, "ret+= ").replace(rUnescapeQuotes, "$1") + ";\n"]);
			}
		} else if (tagName) {
			if (tagName === "else") {
				if (rTestElseIf.test(params)) {
					syntaxError('For "{{else if expr}}" use "{{else expr}}"');
				}
				pathBindings = current[9] && [[]];
				current[10] = markup.substring(current[10], index); // contentMarkup for block tag
				openTagName = current[11] || current[0] || syntaxError("Mismatched: " + all);
				// current[0] is tagName, but for {{else}} nodes, current[11] is tagName of preceding open tag
				current = stack.pop();
				content = current[2];
				block = true;
			}
			if (params) {
				// remove newlines from the params string, to avoid compiled code errors for unterminated strings
				parseParams(params.replace(rNewLine, " "), pathBindings, tmpl, isLinkExpr)
					.replace(rBuildHash, function(all, onerror, isCtxPrm, key, keyToken, keyValue, arg, param) {
						if (key === "this:") {
							keyValue = "undefined"; // this=some.path is always a to parameter (one-way), so don't need to compile/evaluate some.path initialization
						}
						if (param) {
							isLateOb = isLateOb || param[0] === "@";
						}
						key = "'" + keyToken + "':";
						if (arg) {
							args += isCtxPrm + keyValue + ",";
							paramsArgs += "'" + param + "',";
						} else if (isCtxPrm) { // Contextual parameter, ~foo=expr
							ctxProps += key + 'j._cp(' + keyValue + ',"' + param + '",view),';
							// Compiled code for evaluating tagCtx on a tag will have: ctx:{'foo':j._cp(compiledExpr, "expr", view)}
							paramsCtxProps += key + "'" + param + "',";
						} else if (onerror) {
							onError += keyValue;
						} else {
							if (keyToken === "trigger") {
								useTrigger += keyValue;
							}
							if (keyToken === "lateRender") {
								late = param !== "false"; // Render after first pass
							}
							props += key + keyValue + ",";
							paramsProps += key + "'" + param + "',";
							hasHandlers = hasHandlers || rHasHandlers.test(keyToken);
						}
						return "";
					}).slice(0, -1);
			}

			if (pathBindings && pathBindings[0]) {
				pathBindings.pop(); // Remove the binding that was prepared for next arg. (There is always an extra one ready).
			}

			newNode = [
					tagName,
					converter || !!convertBack || hasHandlers || "",
					block && [],
					parsedParam(paramsArgs || (tagName === ":" ? "'#data'," : ""), paramsProps, paramsCtxProps), // {{:}} equivalent to {{:#data}}
					parsedParam(args || (tagName === ":" ? "data," : ""), props, ctxProps),
					onError,
					useTrigger,
					late,
					isLateOb,
					pathBindings || 0
				];
			content.push(newNode);
			if (block) {
				stack.push(current);
				current = newNode;
				current[10] = loc; // Store current location of open tag, to be able to add contentMarkup when we reach closing tag
				current[11] = openTagName; // Used for checking syntax (matching close tag)
			}
		} else if (closeBlock) {
			blockTagCheck(closeBlock !== current[0] && closeBlock !== current[11] && closeBlock, current[0]); // Check matching close tag name
			current[10] = markup.substring(current[10], index); // contentMarkup for block tag
			current = stack.pop();
		}
		blockTagCheck(!current && closeBlock);
		content = current[2];
	}
	//==== /end of nested functions ====

	var i, result, newNode, hasHandlers, bindings,
		allowCode = $subSettings.allowCode || tmpl && tmpl.allowCode
			|| $viewsSettings.allowCode === true, // include direct setting of settings.allowCode true for backward compat only
		astTop = [],
		loc = 0,
		stack = [],
		content = astTop,
		current = [,,astTop];

	if (allowCode && tmpl._is) {
		tmpl.allowCode = allowCode;
	}

//TODO	result = tmplFnsCache[markup]; // Only cache if template is not named and markup length < ...,
//and there are no bindings or subtemplates?? Consider standard optimization for data-link="a.b.c"
//		if (result) {
//			tmpl.fn = result;
//		} else {

//		result = markup;
	if (isLinkExpr) {
		if (convertBack !== undefined) {
			markup = markup.slice(0, -convertBack.length - 2) + delimCloseChar0;
		}
		markup = delimOpenChar0 + markup + delimCloseChar1;
	}

	blockTagCheck(stack[0] && stack[0][2].pop()[0]);
	// Build the AST (abstract syntax tree) under astTop
	markup.replace(rTag, parseTag);

	pushprecedingContent(markup.length);

	if (loc = astTop[astTop.length - 1]) {
		blockTagCheck("" + loc !== loc && (+loc[10] === loc[10]) && loc[0]);
	}
//			result = tmplFnsCache[markup] = buildCode(astTop, tmpl);
//		}

	if (isLinkExpr) {
		result = buildCode(astTop, markup, isLinkExpr);
		bindings = [];
		i = astTop.length;
		while (i--) {
			bindings.unshift(astTop[i][9]); // With data-link expressions, pathBindings array for tagCtx[i] is astTop[i][9]
		}
		setPaths(result, bindings);
	} else {
		result = buildCode(astTop, tmpl);
	}
	return result;
}

function setPaths(fn, pathsArr) {
	var key, paths,
		i = 0,
		l = pathsArr.length;
	fn.deps = [];
	fn.paths = []; // The array of path binding (array/dictionary)s for each tag/else block's args and props
	for (; i < l; i++) {
		fn.paths.push(paths = pathsArr[i]);
		for (key in paths) {
			if (key !== "_jsvto" && paths.hasOwnProperty(key) && paths[key].length && !paths[key].skp) {
				fn.deps = fn.deps.concat(paths[key]); // deps is the concatenation of the paths arrays for the different bindings
			}
		}
	}
}

function parsedParam(args, props, ctx) {
	return [args.slice(0, -1), props.slice(0, -1), ctx.slice(0, -1)];
}

function paramStructure(paramCode, paramVals) {
	return '\n\tparams:{args:[' + paramCode[0] + '],\n\tprops:{' + paramCode[1] + '}'
		+ (paramCode[2] ? ',\n\tctx:{' + paramCode[2] + '}' : "")
		+ '},\n\targs:[' + paramVals[0] + '],\n\tprops:{' + paramVals[1] + '}'
		+ (paramVals[2] ? ',\n\tctx:{' + paramVals[2] + '}' : "");
}

function parseParams(params, pathBindings, tmpl, isLinkExpr) {

	function parseTokens(all, lftPrn0, lftPrn, bound, path, operator, err, eq, path2, late, prn,
												comma, lftPrn2, apos, quot, rtPrn, rtPrnDot, prn2, space, index, full) {
	// /(\()(?=\s*\()|(?:([([])\s*)?(?:(\^?)(~?[\w$.^]+)?\s*((\+\+|--)|\+|-|~(?![\w$])|&&|\|\||===|!==|==|!=|<=|>=|[<>%*:?\/]|(=))\s*|(!*?(@)?[#~]?[\w$.^]+)([([])?)|(,\s*)|(?:(\()\s*)?\\?(?:(')|("))|(?:\s*(([)\]])(?=[.^]|\s*$|[^([])|[)\]])([([]?))|(\s+)/g,
	//lftPrn0           lftPrn         bound     path               operator     err                                          eq      path2 late            prn      comma  lftPrn2          apos quot        rtPrn  rtPrnDot                  prn2     space
	// (left paren? followed by (path? followed by operator) or (path followed by paren?)) or comma or apos or quot or right paren or space

		function parsePath(allPath, not, object, helper, view, viewProperty, pathTokens, leafToken) {
			// /^(!*?)(?:null|true|false|\d[\d.]*|([\w$]+|\.|~([\w$]+)|#(view|([\w$]+))?)([\w$.^]*?)(?:[.[^]([\w$]+)\]?)?)$/g,
			//    not                               object     helper    view  viewProperty pathTokens      leafToken
			subPath = object === ".";
			if (object) {
				path = path.slice(not.length);
				if (/^\.?constructor$/.test(leafToken||path)) {
					syntaxError(allPath);
				}
				if (!subPath) {
					allPath = (late // late path @a.b.c: not throw on 'property of undefined' if a undefined, and will use _getOb() after linking to resolve late.
							? (isLinkExpr ? '' : '(ltOb.lt=ltOb.lt||') + '(ob='
							: ""
						)
						+ (helper
							? 'view.ctxPrm("' + helper + '")'
							: view
								? "view"
								: "data")
						+ (late
							? ')===undefined' + (isLinkExpr ? '' : ')') + '?"":view._getOb(ob,"'
							: ""
						)
						+ (leafToken
							? (viewProperty
								? "." + viewProperty
								: helper
									? ""
									: (view ? "" : "." + object)
								) + (pathTokens || "")
							: (leafToken = helper ? "" : view ? viewProperty || "" : object, ""));
					allPath = allPath + (leafToken ? "." + leafToken : "");

					allPath = not + (allPath.slice(0, 9) === "view.data"
						? allPath.slice(5) // convert #view.data... to data...
						: allPath)
					+ (late
							? (isLinkExpr ? '"': '",ltOb') + (prn ? ',1)':')')
							: ""
						);
				}
				if (bindings) {
					binds = named === "_linkTo" ? (bindto = pathBindings._jsvto = pathBindings._jsvto || []) : bndCtx.bd;
					if (theOb = subPath && binds[binds.length-1]) {
						if (theOb._cpfn) { // Computed property exprOb
							while (theOb.sb) {
								theOb = theOb.sb;
							}
							if (theOb.prm) {
								if (theOb.bnd) {
									path = "^" + path.slice(1);
								}
								theOb.sb = path;
								theOb.bnd = theOb.bnd || path[0] === "^";
							}
						}
					} else {
						binds.push(path);
					}
					if (prn && !subPath) {
						pathStart[fnDp] = ind;
						compiledPathStart[fnDp] = compiledPath[fnDp].length;
					}
				}
			}
			return allPath;
		}

		//bound = bindings && bound;
		if (bound && !eq) {
			path = bound + path; // e.g. some.fn(...)^some.path - so here path is "^some.path"
		}
		operator = operator || "";
		lftPrn2 = lftPrn2 || "";
		lftPrn = lftPrn || lftPrn0 || lftPrn2;
		path = path || path2;

		if (late && (late = !/\)|]/.test(full[index-1]))) {
			path = path.slice(1).split(".").join("^"); // Late path @z.b.c. Use "^" rather than "." to ensure that deep binding will be used
		}
		// Could do this - but not worth perf cost?? :-
		// if (!path.lastIndexOf("#data.", 0)) { path = path.slice(6); } // If path starts with "#data.", remove that.
		prn = prn || prn2 || "";
		var expr, binds, theOb, newOb, subPath, lftPrnFCall, ret,
			ind = index;

		if (!aposed && !quoted) {
			if (err) {
				syntaxError(params);
			}
			if (rtPrnDot && bindings) {
				// This is a binding to a path in which an object is returned by a helper/data function/expression, e.g. foo()^x.y or (a?b:c)^x.y
				// We create a compiled function to get the object instance (which will be called when the dependent data of the subexpression changes,
				// to return the new object, and trigger re-binding of the subsequent path)
				expr = pathStart[fnDp-1];
				if (full.length - 1 > ind - (expr || 0)) { // We need to compile a subexpression
					expr = $.trim(full.slice(expr, ind + all.length));
					binds = bindto || bndStack[fnDp-1].bd;
					// Insert exprOb object, to be used during binding to return the computed object
					theOb = binds[binds.length-1];
					if (theOb && theOb.prm) {
						while (theOb.sb && theOb.sb.prm) {
							theOb = theOb.sb;
						}
						newOb = theOb.sb = {path: theOb.sb, bnd: theOb.bnd};
					} else {
						binds.push(newOb = {path: binds.pop()}); // Insert exprOb object, to be used during binding to return the computed object
					}
					if (theOb && theOb.sb === newOb) {
						compiledPath[fnDp] = compiledPath[fnDp-1].slice(theOb._cpPthSt) + compiledPath[fnDp];
						compiledPath[fnDp-1] = compiledPath[fnDp-1].slice(0, theOb._cpPthSt);
					}
					newOb._cpPthSt = compiledPathStart[fnDp-1];
					newOb._cpKey = expr;

					compiledPath[fnDp] += full.slice(prevIndex, index);
					prevIndex = index;

					newOb._cpfn = cpFnStore[expr] = cpFnStore[expr] || // Compiled function for computed value: get from store, or compile and store
						new Function("data,view,j", // Compiled function for computed value in template
					"//" + expr + "\nvar v;\nreturn ((v=" + compiledPath[fnDp] + (rtPrn === "]" ? ")]" : rtPrn) + ")!=null?v:null);");

					compiledPath[fnDp-1] += (fnCall[prnDp] && $subSettingsAdvanced.cache ? "view.getCache(\"" + expr.replace(rEscapeQuotes, "\\$&") + "\"" : compiledPath[fnDp]);

					newOb.prm = bndCtx.bd;
					newOb.bnd = newOb.bnd || newOb.path && newOb.path.indexOf("^") >= 0;
				}
				compiledPath[fnDp] = "";
			}
			if (prn === "[") {
				prn = "[j._sq(";
			}
			if (lftPrn === "[") {
				lftPrn = "[j._sq(";
			}
		}
		ret = (aposed
			// within single-quoted string
			? (aposed = !apos, (aposed ? all : lftPrn2 + '"'))
			: quoted
			// within double-quoted string
				? (quoted = !quot, (quoted ? all : lftPrn2 + '"'))
				:
			(
				(lftPrn
					? (
						prnStack[++prnDp] = true,
						prnInd[prnDp] = 0,
						bindings && (
							pathStart[fnDp++] = ind++,
							bndCtx = bndStack[fnDp] = {bd: []},
							compiledPath[fnDp] = "",
							compiledPathStart[fnDp] = 1
						),
						lftPrn) // Left paren, (not a function call paren)
					: "")
				+ (space
					? (prnDp
						? "" // A space within parens or within function call parens, so not a separator for tag args
			// New arg or prop - so insert backspace \b (\x08) as separator for named params, used subsequently by rBuildHash, and prepare new bindings array
						: (paramIndex = full.slice(paramIndex, ind), named
							? (named = boundName = bindto = false, "\b")
							: "\b,") + paramIndex + (paramIndex = ind + all.length, bindings && pathBindings.push(bndCtx.bd = []), "\b")
					)
					: eq
			// named param. Remove bindings for arg and create instead bindings array for prop
						? (fnDp && syntaxError(params), bindings && pathBindings.pop(), named = "_" + path, boundName = bound, paramIndex = ind + all.length,
								bindings && ((bindings = bndCtx.bd = pathBindings[named] = []), bindings.skp = !bound), path + ':')
						: path
			// path
							? (path.split("^").join(".").replace($sub.rPath, parsePath)
								+ (prn || operator)
							)
							: operator
			// operator
								? operator
								: rtPrn
			// function
									? rtPrn === "]" ? ")]" : ")"
									: comma
										? (fnCall[prnDp] || syntaxError(params), ",") // We don't allow top-level literal arrays or objects
										: lftPrn0
											? ""
											: (aposed = apos, quoted = quot, '"')
			))
		);

		if (!aposed && !quoted) {
			if (rtPrn) {
				fnCall[prnDp] = false;
				prnDp--;
			}
		}

		if (bindings) {
			if (!aposed && !quoted) {
				if (rtPrn) {
					if (prnStack[prnDp+1]) {
						bndCtx = bndStack[--fnDp];
						prnStack[prnDp+1] = false;
					}
					prnStart = prnInd[prnDp+1];
				}
				if (prn) {
					prnInd[prnDp+1] = compiledPath[fnDp].length + (lftPrn ? 1 : 0);
					if (path || rtPrn) {
						bndCtx = bndStack[++fnDp] = {bd: []};
						prnStack[prnDp+1] = true;
					}
				}
			}

			compiledPath[fnDp] = (compiledPath[fnDp]||"") + full.slice(prevIndex, index);
			prevIndex = index+all.length;

			if (!aposed && !quoted) {
				if (lftPrnFCall = lftPrn && prnStack[prnDp+1]) {
					compiledPath[fnDp-1] += lftPrn;
					compiledPathStart[fnDp-1]++;
				}
				if (prn === "(" && subPath && !newOb) {
					compiledPath[fnDp] = compiledPath[fnDp-1].slice(prnStart) + compiledPath[fnDp];
					compiledPath[fnDp-1] = compiledPath[fnDp-1].slice(0, prnStart);
				}
			}
			compiledPath[fnDp] += lftPrnFCall ? ret.slice(1) : ret;
		}

		if (!aposed && !quoted && prn) {
			prnDp++;
			if (path && prn === "(") {
				fnCall[prnDp] = true;
			}
		}

		if (!aposed && !quoted && prn2) {
			if (bindings) {
				compiledPath[fnDp] += prn;
			}
			ret += prn;
		}
		return ret;
	}

	var named, bindto, boundName, result,
		quoted, // boolean for string content in double quotes
		aposed, // or in single quotes
		bindings = pathBindings && pathBindings[0], // bindings array for the first arg
		bndCtx = {bd: bindings},
		bndStack = {0: bndCtx},
		paramIndex = 0, // list,
		// The following are used for tracking path parsing including nested paths, such as "a.b(c^d + (e))^f", and chained computed paths such as
		// "a.b().c^d().e.f().g" - which has four chained paths, "a.b()", "^c.d()", ".e.f()" and ".g"
		prnDp = 0,     // For tracking paren depth (not function call parens)
		fnDp = 0,      // For tracking depth of function call parens
		prnInd = {},   // We are in a function call
		prnStart = 0,  // tracks the start of the current path such as c^d() in the above example
		prnStack = {}, // tracks parens which are not function calls, and so are associated with new bndStack contexts
		fnCall = {},   // We are in a function call
		pathStart = {},// tracks the start of the current path such as c^d() in the above example
		compiledPathStart = {0: 0},
		compiledPath = {0:""},
		prevIndex = 0;

	if (params[0] === "@") {
		params = params.replace(rBracketQuote, ".");
	}
	result = (params + (tmpl ? " " : "")).replace($sub.rPrm, parseTokens);

	if (bindings) {
		result = compiledPath[0];
	}

	return !prnDp && result || syntaxError(params); // Syntax error if unbalanced parens in params expression
}

function buildCode(ast, tmpl, isLinkExpr) {
	// Build the template function code from the AST nodes, and set as property on the passed-in template object
	// Used for compiling templates, and also by JsViews to build functions for data link expressions
	var i, node, tagName, converter, tagCtx, hasTag, hasEncoder, getsVal, hasCnvt, useCnvt, tmplBindings, pathBindings, params, boundOnErrStart,
		boundOnErrEnd, tagRender, nestedTmpls, tmplName, nestedTmpl, tagAndElses, content, markup, nextIsElse, oldCode, isElse, isGetVal, tagCtxFn,
		onError, tagStart, trigger, lateRender, retStrOpen, retStrClose,
		tmplBindingKey = 0,
		useViews = $subSettingsAdvanced.useViews || tmpl.useViews || tmpl.tags || tmpl.templates || tmpl.helpers || tmpl.converters,
		code = "",
		tmplOptions = {},
		l = ast.length;

	if ("" + tmpl === tmpl) {
		tmplName = isLinkExpr ? 'data-link="' + tmpl.replace(rNewLine, " ").slice(1, -1) + '"' : tmpl;
		tmpl = 0;
	} else {
		tmplName = tmpl.tmplName || "unnamed";
		if (tmpl.allowCode) {
			tmplOptions.allowCode = true;
		}
		if (tmpl.debug) {
			tmplOptions.debug = true;
		}
		tmplBindings = tmpl.bnds;
		nestedTmpls = tmpl.tmpls;
	}
	for (i = 0; i < l; i++) {
		// AST nodes: [0: tagName, 1: converter, 2: content, 3: params, 4: code, 5: onError, 6: trigger, 7:pathBindings, 8: contentMarkup]
		node = ast[i];

		// Add newline for each callout to t() c() etc. and each markup string
		if ("" + node === node) {
			// a markup string to be inserted
			code += '+"' + node + '"';
		} else {
			// a compiled tag expression to be inserted
			tagName = node[0];
			if (tagName === "*") {
				// Code tag: {{* }}
				code += ";\n" + node[1] + "\nret=ret";
			} else {
				converter = node[1];
				content = !isLinkExpr && node[2];
				tagCtx = paramStructure(node[3], params = node[4]);
				trigger = node[6];
				lateRender = node[7];
				if (node[8]) { // latePath @a.b.c or @~a.b.c
					retStrOpen = "\nvar ob,ltOb={},ctxs=";
					retStrClose = ";\nctxs.lt=ltOb.lt;\nreturn ctxs;";
				} else {
					retStrOpen = "\nreturn ";
					retStrClose = "";
				}
				markup = node[10] && node[10].replace(rUnescapeQuotes, "$1");
				if (isElse = tagName === "else") {
					if (pathBindings) {
						pathBindings.push(node[9]);
					}
				} else {
					onError = node[5] || $subSettings.debugMode !== false && "undefined"; // If debugMode not false, set default onError handler on tag to "undefined" (see onRenderError)
					if (tmplBindings && (pathBindings = node[9])) { // Array of paths, or false if not data-bound
						pathBindings = [pathBindings];
						tmplBindingKey = tmplBindings.push(1); // Add placeholder in tmplBindings for compiled function
					}
				}
				useViews = useViews || params[1] || params[2] || pathBindings || /view.(?!index)/.test(params[0]);
				// useViews is for perf optimization. For render() we only use views if necessary - for the more advanced scenarios.
				// We use views if there are props, contextual properties or args with #... (other than #index) - but you can force
				// using the full view infrastructure, (and pay a perf price) by opting in: Set useViews: true on the template, manually...
				if (isGetVal = tagName === ":") {
					if (converter) {
						tagName = converter === HTML ? ">" : converter + tagName;
					}
				} else {
					if (content) { // TODO optimize - if content.length === 0 or if there is a tmpl="..." specified - set content to null / don't run this compilation code - since content won't get used!!
						// Create template object for nested template
						nestedTmpl = tmplObject(markup, tmplOptions);
						nestedTmpl.tmplName = tmplName + "/" + tagName;
						// Compile to AST and then to compiled function
						nestedTmpl.useViews = nestedTmpl.useViews || useViews;
						buildCode(content, nestedTmpl);
						useViews = nestedTmpl.useViews;
						nestedTmpls.push(nestedTmpl);
					}

					if (!isElse) {
						// This is not an else tag.
						tagAndElses = tagName;
						useViews = useViews || tagName && (!$tags[tagName] || !$tags[tagName].flow);
						// Switch to a new code string for this bound tag (and its elses, if it has any) - for returning the tagCtxs array
						oldCode = code;
						code = "";
					}
					nextIsElse = ast[i + 1];
					nextIsElse = nextIsElse && nextIsElse[0] === "else";
				}
				tagStart = onError ? ";\ntry{\nret+=" : "\n+";
				boundOnErrStart = "";
				boundOnErrEnd = "";

				if (isGetVal && (pathBindings || trigger || converter && converter !== HTML || lateRender)) {
					// For convertVal we need a compiled function to return the new tagCtx(s)
					tagCtxFn = new Function("data,view,j", "// " + tmplName + " " + (++tmplBindingKey) + " " + tagName
						+ retStrOpen + "{" + tagCtx + "};" + retStrClose);
					tagCtxFn._er = onError;
					tagCtxFn._tag = tagName;
					tagCtxFn._bd = !!pathBindings; // data-linked tag {^{.../}}
					tagCtxFn._lr = lateRender;

					if (isLinkExpr) {
						return tagCtxFn;
					}

					setPaths(tagCtxFn, pathBindings);
					tagRender = 'c("' + converter + '",view,';
					useCnvt = true;
					boundOnErrStart = tagRender + tmplBindingKey + ",";
					boundOnErrEnd = ")";
				}
				code += (isGetVal
					? (isLinkExpr ? (onError ? "try{\n" : "") + "return " : tagStart) + (useCnvt // Call _cnvt if there is a converter: {{cnvt: ... }} or {^{cnvt: ... }}
						? (useCnvt = undefined, useViews = hasCnvt = true, tagRender + (tagCtxFn
							? ((tmplBindings[tmplBindingKey - 1] = tagCtxFn), tmplBindingKey) // Store the compiled tagCtxFn in tmpl.bnds, and pass the key to convertVal()
							: "{" + tagCtx + "}") + ")")
						: tagName === ">"
							? (hasEncoder = true, "h(" + params[0] + ")")
							: (getsVal = true, "((v=" + params[0] + ')!=null?v:' + (isLinkExpr ? 'null)' : '"")'))
							// Non strict equality so data-link="title{:expr}" with expr=null/undefined removes title attribute
					)
					: (hasTag = true, "\n{view:view,content:false,tmpl:" // Add this tagCtx to the compiled code for the tagCtxs to be passed to renderTag()
						+ (content ? nestedTmpls.length : "false") + "," // For block tags, pass in the key (nestedTmpls.length) to the nested content template
						+ tagCtx + "},"));

				if (tagAndElses && !nextIsElse) {
					// This is a data-link expression or an inline tag without any elses, or the last {{else}} of an inline tag
					// We complete the code for returning the tagCtxs array
					code = "[" + code.slice(0, -1) + "]";
					tagRender = 't("' + tagAndElses + '",view,this,';
					if (isLinkExpr || pathBindings) {
						// This is a bound tag (data-link expression or inline bound tag {^{tag ...}}) so we store a compiled tagCtxs function in tmp.bnds
						code = new Function("data,view,j", " // " + tmplName + " " + tmplBindingKey + " " + tagAndElses + retStrOpen + code
							+ retStrClose);
						code._er = onError;
						code._tag = tagAndElses;
						if (pathBindings) {
							setPaths(tmplBindings[tmplBindingKey - 1] = code, pathBindings);
						}
						code._lr = lateRender;
						if (isLinkExpr) {
							return code; // For a data-link expression we return the compiled tagCtxs function
						}
						boundOnErrStart = tagRender + tmplBindingKey + ",undefined,";
						boundOnErrEnd = ")";
					}

					// This is the last {{else}} for an inline tag.
					// For a bound tag, pass the tagCtxs fn lookup key to renderTag.
					// For an unbound tag, include the code directly for evaluating tagCtxs array
					code = oldCode + tagStart + tagRender + (pathBindings && tmplBindingKey || code) + ")";
					pathBindings = 0;
					tagAndElses = 0;
				}
				if (onError && !nextIsElse) {
					useViews = true;
					code += ';\n}catch(e){ret' + (isLinkExpr ? "urn " : "+=") + boundOnErrStart + 'j._err(e,view,' + onError + ')' + boundOnErrEnd + ';}' + (isLinkExpr ? "" : '\nret=ret');
				}
			}
		}
	}
	// Include only the var references that are needed in the code
	code = "// " + tmplName
		+ (tmplOptions.debug ? "\ndebugger;" : "")
		+ "\nvar v"
		+ (hasTag ? ",t=j._tag" : "")                // has tag
		+ (hasCnvt ? ",c=j._cnvt" : "")              // converter
		+ (hasEncoder ? ",h=j._html" : "")           // html converter
		+ (isLinkExpr
				? (node[8] // late @... path?
						? ", ob"
						: ""
					) + ";\n"
				: ',ret=""')
		+ code
		+ (isLinkExpr ? "\n" : ";\nreturn ret;");

	try {
		code = new Function("data,view,j", code);
	} catch (e) {
		syntaxError("Compiled template code:\n\n" + code + '\n: "' + (e.message||e) + '"');
	}
	if (tmpl) {
		tmpl.fn = code;
		tmpl.useViews = !!useViews;
	}
	return code;
}

//==========
// Utilities
//==========

// Merge objects, in particular contexts which inherit from parent contexts
function extendCtx(context, parentContext) {
	// Return copy of parentContext, unless context is defined and is different, in which case return a new merged context
	// If neither context nor parentContext are defined, return undefined
	return context && context !== parentContext
		? (parentContext
			? $extend($extend({}, parentContext), context)
			: context)
		: parentContext && $extend({}, parentContext);
}

function getTargetProps(source, tagCtx) {
	// this pointer is theMap - which has tagCtx.props too
	// arguments: tagCtx.args.
	var key, prop,
		map = tagCtx.map,
		propsArr = map && map.propsArr;

	if (!propsArr) { // map.propsArr is the full array of {key:..., prop:...} objects
		propsArr = [];
		if (typeof source === OBJECT || $isFunction(source)) {
			for (key in source) {
				prop = source[key];
				if (key !== $expando && source.hasOwnProperty(key) && (!tagCtx.props.noFunctions || !$.isFunction(prop))) {
					propsArr.push({key: key, prop: prop});
				}
			}
		}
		if (map) {
			map.propsArr = map.options && propsArr; // If bound {^{props}} and not isRenderCall, store propsArr on map (map.options is defined only for bound, && !isRenderCall)
		}
	}
	return getTargetSorted(propsArr, tagCtx); // Obtains map.tgt, by filtering, sorting and splicing the full propsArr
}

function getTargetSorted(value, tagCtx) {
	// getTgt
	var mapped, start, end,
		tag = tagCtx.tag,
		props = tagCtx.props,
		propParams = tagCtx.params.props,
		filter = props.filter,
		sort = props.sort,
		directSort = sort === true,
		step = parseInt(props.step),
		reverse = props.reverse ? -1 : 1;

	if (!$isArray(value)) {
		return value;
	}
	if (directSort || sort && "" + sort === sort) {
		// Temporary mapped array holds objects with index and sort-value
		mapped = value.map(function(item, i) {
			item = directSort ? item : getPathObject(item, sort);
			return {i: i, v: "" + item === item ? item.toLowerCase() : item};
		});
		// Sort mapped array
		mapped.sort(function(a, b) {
			return a.v > b.v ? reverse : a.v < b.v ? -reverse : 0;
		});
		// Map to new array with resulting order
		value = mapped.map(function(item){
			return value[item.i];
		});
	} else if ((sort || reverse < 0) && !tag.dataMap) {
		value = value.slice(); // Clone array first if not already a new array
	}
	if ($isFunction(sort)) {
		value = value.sort(function() { // Wrap the sort function to provide tagCtx as 'this' pointer
			return sort.apply(tagCtx, arguments);
		});
	}
	if (reverse < 0 && (!sort || $isFunction(sort))) { // Reverse result if not already reversed in sort
		value = value.reverse();
	}

	if (value.filter && filter) { // IE8 does not support filter
		value = value.filter(filter, tagCtx);
		if (tagCtx.tag.onFilter) {
			tagCtx.tag.onFilter(tagCtx);
		}
	}

	if (propParams.sorted) {
		mapped = (sort || reverse < 0) ? value : value.slice();
		if (tag.sorted) {
			$.observable(tag.sorted).refresh(mapped); // Note that this might cause the start and end props to be modified - e.g. by pager tag control
		} else {
			tagCtx.map.sorted = mapped;
		}
	}

	start = props.start; // Get current value - after possible changes triggered by tag.sorted refresh() above
	end = props.end;
	if (propParams.start && start === undefined || propParams.end && end === undefined) {
		start = end = 0;
	}
	if (!isNaN(start) || !isNaN(end)) { // start or end specified, but not the auto-create Number array scenario of {{for start=xxx end=yyy}}
		start = +start || 0;
		end = end === undefined || end > value.length ? value.length : +end;
		value = value.slice(start, end);
	}
	if (step > 1) {
		start = 0;
		end = value.length;
		mapped = [];
		for (; start<end; start+=step) {
			mapped.push(value[start]);
		}
		value = mapped;
	}
	if (propParams.paged && tag.paged) {
		$observable(tag.paged).refresh(value);
	}

	return value;
}

/** Render the template as a string, using the specified data and helpers/context
* $("#tmpl").render()
*
* @param {any}        data
* @param {hash}       [helpersOrContext]
* @param {boolean}    [noIteration]
* @returns {string}   rendered template
*/
function $fnRender(data, context, noIteration) {
	var tmplElem = this.jquery && (this[0] || error('Unknown template')), // Targeted element not found for jQuery template selector such as "#myTmpl"
		tmpl = tmplElem.getAttribute(tmplAttr);

	return renderContent.call(tmpl && $.data(tmplElem)[jsvTmpl] || $templates(tmplElem),
		data, context, noIteration);
}

//========================== Register converters ==========================

function getCharEntity(ch) {
	// Get character entity for HTML, Attribute and optional data encoding
	return charEntities[ch] || (charEntities[ch] = "&#" + ch.charCodeAt(0) + ";");
}

function getCharFromEntity(match, token) {
	// Get character from HTML entity, for optional data unencoding
	return charsFromEntities[token] || "";
}

function htmlEncode(text) {
	// HTML encode: Replace < > & ' " ` etc. by corresponding entities.
	return text != undefined ? rIsHtml.test(text) && ("" + text).replace(rHtmlEncode, getCharEntity) || text : "";
}

function dataEncode(text) {
	// Encode just < > and & - intended for 'safe data' along with {{:}} rather than {{>}}
  return "" + text === text ? text.replace(rDataEncode, getCharEntity) : text;
}

function dataUnencode(text) {
  // Unencode just < > and & - intended for 'safe data' along with {{:}} rather than {{>}}
  return "" + text === text ? text.replace(rDataUnencode, getCharFromEntity) : text;
}

//========================== Initialize ==========================

$sub = $views.sub;
$viewsSettings = $views.settings;

if (!(jsr || $ && $.render)) {
	// JsRender/JsViews not already loaded (or loaded without jQuery, and we are now moving from jsrender namespace to jQuery namepace)
	for (jsvStoreName in jsvStores) {
		registerStore(jsvStoreName, jsvStores[jsvStoreName]);
	}

	$converters = $views.converters;
	$helpers = $views.helpers;
	$tags = $views.tags;

	$sub._tg.prototype = {
		baseApply: baseApply,
		cvtArgs: convertArgs,
		bndArgs: convertBoundArgs,
		ctxPrm: contextParameter
	};

	topView = $sub.topView = new View();

	//BROWSER-SPECIFIC CODE
	if ($) {

		////////////////////////////////////////////////////////////////////////////////////////////////
		// jQuery (= $) is loaded

		$.fn.render = $fnRender;
		$expando = $.expando;
		if ($.observable) {
			if (versionNumber !== (versionNumber = $.views.jsviews)) {
				// Different version of jsRender was loaded
				throw "jquery.observable.js requires jsrender.js " + versionNumber;
			}
			$extend($sub, $.views.sub); // jquery.observable.js was loaded before jsrender.js
			$views.map = $.views.map;
		}

	} else {
		////////////////////////////////////////////////////////////////////////////////////////////////
		// jQuery is not loaded.

		$ = {};

		if (setGlobals) {
			global.jsrender = $; // We are loading jsrender.js from a script element, not AMD or CommonJS, so set global
		}

		// Error warning if jsrender.js is used as template engine on Node.js (e.g. Express or Hapi...)
		// Use jsrender-node.js instead...
		$.renderFile = $.__express = $.compile = function() { throw "Node.js: use npm jsrender, or jsrender-node.js"; };

		//END BROWSER-SPECIFIC CODE
		$.isFunction = function(ob) {
			return typeof ob === "function";
		};

		$.isArray = Array.isArray || function(obj) {
			return ({}.toString).call(obj) === "[object Array]";
		};

		$sub._jq = function(jq) { // private method to move from JsRender APIs from jsrender namespace to jQuery namespace
			if (jq !== $) {
				$extend(jq, $); // map over from jsrender namespace to jQuery namespace
				$ = jq;
				$.fn.render = $fnRender;
				delete $.jsrender;
				$expando = $.expando;
			}
		};

		$.jsrender = versionNumber;
	}
	$subSettings = $sub.settings;
	$subSettings.allowCode = false;
	$isFunction = $.isFunction;
	$.render = $render;
	$.views = $views;
	$.templates = $templates = $views.templates;

	for (setting in $subSettings) {
		addSetting(setting);
	}

	/**
	* $.views.settings.debugMode(true)
	* @param {boolean} debugMode
	* @returns {Settings}
	*
	* debugMode = $.views.settings.debugMode()
	* @returns {boolean}
	*/
	($viewsSettings.debugMode = function(debugMode) {
		return debugMode === undefined
			? $subSettings.debugMode
			: (
				$subSettings._clFns && $subSettings._clFns(), // Clear linkExprStore (cached compiled expressions), since debugMode setting affects compilation for expressions
				$subSettings.debugMode = debugMode,
				$subSettings.onError = debugMode + "" === debugMode
					? function() { return debugMode; }
					: $isFunction(debugMode)
						? debugMode
						: undefined,
				$viewsSettings);
	})(false); // jshint ignore:line

	$subSettingsAdvanced = $subSettings.advanced = {
		cache: true, // By default use cached values of computed values (Otherwise, set advanced cache setting to false)
		useViews: false,
		_jsv: false // For global access to JsViews store
	};

	//========================== Register tags ==========================

	$tags({
		"if": {
			render: function(val) {
				// This function is called once for {{if}} and once for each {{else}}.
				// We will use the tag.rendering object for carrying rendering state across the calls.
				// If not done (a previous block has not been rendered), look at expression for this block and render the block if expression is truthy
				// Otherwise return ""
				var self = this,
					tagCtx = self.tagCtx,
					ret = (self.rendering.done || !val && (tagCtx.args.length || !tagCtx.index))
						? ""
						: (self.rendering.done = true,
							self.selected = tagCtx.index,
							undefined); // Test is satisfied, so render content on current context
				return ret;
			},
			contentCtx: true, // Inherit parent view data context
			flow: true
		},
		"for": {
			sortDataMap: dataMap(getTargetSorted),
			init: function(val, cloned) {
				this.setDataMap(this.tagCtxs);
			},
			render: function(val) {
				// This function is called once for {{for}} and once for each {{else}}.
				// We will use the tag.rendering object for carrying rendering state across the calls.
				var value, filter, srtField, isArray, i, sorted, end, step,
					self = this,
					tagCtx = self.tagCtx,
					range = tagCtx.argDefault === false,
					props = tagCtx.props,
					iterate = range || tagCtx.args.length, // Not final else and not auto-create range
					result = "",
					done = 0;

				if (!self.rendering.done) {
					value = iterate ? val : tagCtx.view.data; // For the final else, defaults to current data without iteration.

					if (range) {
						range = props.reverse ? "unshift" : "push";
						end = +props.end;
						step = +props.step || 1;
						value = []; // auto-create integer array scenario of {{for start=xxx end=yyy}}
						for (i = +props.start || 0; (end - i) * step > 0; i += step) {
							value[range](i);
						}
					}
					if (value !== undefined) {
						isArray = $isArray(value);
						result += tagCtx.render(value, !iterate || props.noIteration);
						// Iterates if data is an array, except on final else - or if noIteration property
						// set to true. (Use {{include}} to compose templates without array iteration)
						done += isArray ? value.length : 1;
					}
					if (self.rendering.done = done) {
						self.selected = tagCtx.index;
					}
					// If nothing was rendered we will look at the next {{else}}. Otherwise, we are done.
				}
				return result;
			},
			setDataMap: function(tagCtxs) {
				var tagCtx, props, paramsProps,
					self = this,
					l = tagCtxs.length;
				while (l--) {
					tagCtx = tagCtxs[l];
					props = tagCtx.props;
					paramsProps = tagCtx.params.props;
					tagCtx.argDefault = props.end === undefined || tagCtx.args.length > 0; // Default to #data except for auto-create range scenario {{for start=xxx end=yyy step=zzz}}
					props.dataMap = (tagCtx.argDefault !== false && $isArray(tagCtx.args[0]) &&
						(paramsProps.sort || paramsProps.start || paramsProps.end || paramsProps.step || paramsProps.filter || paramsProps.reverse
						|| props.sort || props.start || props.end || props.step || props.filter || props.reverse))
						&& self.sortDataMap;
				}
			},
			flow: true
		},
		props: {
			baseTag: "for",
			dataMap: dataMap(getTargetProps),
			init: noop, // Don't execute the base init() of the "for" tag
			flow: true
		},
		include: {
			flow: true
		},
		"*": {
			// {{* code... }} - Ignored if template.allowCode and $.views.settings.allowCode are false. Otherwise include code in compiled template
			render: retVal,
			flow: true
		},
		":*": {
			// {{:* returnedExpression }} - Ignored if template.allowCode and $.views.settings.allowCode are false. Otherwise include code in compiled template
			render: retVal,
			flow: true
		},
		dbg: $helpers.dbg = $converters.dbg = dbgBreak // Register {{dbg/}}, {{dbg:...}} and ~dbg() to throw and catch, as breakpoints for debugging.
	});

	$converters({
		html: htmlEncode,
		attr: htmlEncode, // Includes > encoding since rConvertMarkers in JsViews does not skip > characters in attribute strings
		encode: dataEncode,
		unencode: dataUnencode, // Includes > encoding since rConvertMarkers in JsViews does not skip > characters in attribute strings
		url: function(text) {
			// URL encoding helper.
			return text != undefined ? encodeURI("" + text) : text === null ? text : ""; // null returns null, e.g. to remove attribute. undefined returns ""
		}
	});
}
//========================== Define default delimiters ==========================
$subSettings = $sub.settings;
$isArray = ($||jsr).isArray;
$viewsSettings.delimiters("{{", "}}", "^");

if (jsrToJq) { // Moving from jsrender namespace to jQuery namepace - copy over the stored items (templates, converters, helpers...)
	jsr.views.sub._jq($);
}
return $ || jsr;
}, window));


/***/ }),

/***/ "./resources/assets/css/main.scss":
/*!****************************************!*\
  !*** ./resources/assets/css/main.scss ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/css/landing/front-custom.scss":
/*!********************************************************!*\
  !*** ./resources/assets/css/landing/front-custom.scss ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/pages": 0,
/******/ 			"css/app": 0,
/******/ 			"css/front-custom": 0,
/******/ 			"css/pages": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) var result = runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/turbo.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/custom/helpers.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/custom/custom.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/roles/roles.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/settings/settings.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/dashboard/dashboard.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/dashboard/user-dashboard.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/campaign-category/campaign-category.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/campaign_faqs/campaign_faqs.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/campaign_updates/campaign_updates.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news_comments/news_comments.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/faqs/faqs.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/users/user-profile.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/events/event-participate.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/second_front_slider/second_front_slider.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/event-category/event-category.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/brand/brand.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/sidebar_menu_search/sidebar_menu_search.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/users/user.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/front_slider/front_slider.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/campaigns/campaigns.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/campaigns/create-edit.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/success_story/success_story.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news_tags/news_tags.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news_tags/create_news_tags.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/email_subscribe/create_email_subscribe.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/countries/country.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/pages/pages.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/pages/create-edit.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/inquiries/inquiries.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/call_to_actions/call_to_actions.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/events/event.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news_categories/news_categories.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news/news.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/news/create-edit.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/events/create-edit.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/terms-conditions/terms-conditions.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/third_front_slider/third_front_slider.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/third_category/third_category.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/teams/teams.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/custom/phone-number-country-code.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/languages/languages.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/languages/language_translate.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/user_withdraw/withdraw.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/admin_withdraw/withdraw.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/withdrawal/withdrawal.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/js/donation_gifts/donation_gifts.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/css/main.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/assets/css/landing/front-custom.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app","css/front-custom","css/pages"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;