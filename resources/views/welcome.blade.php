<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Simpede</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link
      href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
      rel="stylesheet"
    />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) ||
    file_exists(public_path('hot'))) @vite(['resources/css/app.css',
    'resources/js/app.js']) @else
    <style>
      /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */
      *,
      :before,
      :after {
        --tw-border-spacing-x: 0;
        --tw-border-spacing-y: 0;
        --tw-translate-x: 0;
        --tw-translate-y: 0;
        --tw-rotate: 0;
        --tw-skew-x: 0;
        --tw-skew-y: 0;
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        --tw-pan-x: ;
        --tw-pan-y: ;
        --tw-pinch-zoom: ;
        --tw-scroll-snap-strictness: proximity;
        --tw-gradient-from-position: ;
        --tw-gradient-via-position: ;
        --tw-gradient-to-position: ;
        --tw-ordinal: ;
        --tw-slashed-zero: ;
        --tw-numeric-figure: ;
        --tw-numeric-spacing: ;
        --tw-numeric-fraction: ;
        --tw-ring-inset: ;
        --tw-ring-offset-width: 0px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: rgb(59 130 246 / 0.5);
        --tw-ring-offset-shadow: 0 0 #0000;
        --tw-ring-shadow: 0 0 #0000;
        --tw-shadow: 0 0 #0000;
        --tw-shadow-colored: 0 0 #0000;
        --tw-blur: ;
        --tw-brightness: ;
        --tw-contrast: ;
        --tw-grayscale: ;
        --tw-hue-rotate: ;
        --tw-invert: ;
        --tw-saturate: ;
        --tw-sepia: ;
        --tw-drop-shadow: ;
        --tw-backdrop-blur: ;
        --tw-backdrop-brightness: ;
        --tw-backdrop-contrast: ;
        --tw-backdrop-grayscale: ;
        --tw-backdrop-hue-rotate: ;
        --tw-backdrop-invert: ;
        --tw-backdrop-opacity: ;
        --tw-backdrop-saturate: ;
        --tw-backdrop-sepia: ;
        --tw-contain-size: ;
        --tw-contain-layout: ;
        --tw-contain-paint: ;
        --tw-contain-style: ;
      }
      ::backdrop {
        --tw-border-spacing-x: 0;
        --tw-border-spacing-y: 0;
        --tw-translate-x: 0;
        --tw-translate-y: 0;
        --tw-rotate: 0;
        --tw-skew-x: 0;
        --tw-skew-y: 0;
        --tw-scale-x: 1;
        --tw-scale-y: 1;
        --tw-pan-x: ;
        --tw-pan-y: ;
        --tw-pinch-zoom: ;
        --tw-scroll-snap-strictness: proximity;
        --tw-gradient-from-position: ;
        --tw-gradient-via-position: ;
        --tw-gradient-to-position: ;
        --tw-ordinal: ;
        --tw-slashed-zero: ;
        --tw-numeric-figure: ;
        --tw-numeric-spacing: ;
        --tw-numeric-fraction: ;
        --tw-ring-inset: ;
        --tw-ring-offset-width: 0px;
        --tw-ring-offset-color: #fff;
        --tw-ring-color: rgb(59 130 246 / 0.5);
        --tw-ring-offset-shadow: 0 0 #0000;
        --tw-ring-shadow: 0 0 #0000;
        --tw-shadow: 0 0 #0000;
        --tw-shadow-colored: 0 0 #0000;
        --tw-blur: ;
        --tw-brightness: ;
        --tw-contrast: ;
        --tw-grayscale: ;
        --tw-hue-rotate: ;
        --tw-invert: ;
        --tw-saturate: ;
        --tw-sepia: ;
        --tw-drop-shadow: ;
        --tw-backdrop-blur: ;
        --tw-backdrop-brightness: ;
        --tw-backdrop-contrast: ;
        --tw-backdrop-grayscale: ;
        --tw-backdrop-hue-rotate: ;
        --tw-backdrop-invert: ;
        --tw-backdrop-opacity: ;
        --tw-backdrop-saturate: ;
        --tw-backdrop-sepia: ;
        --tw-contain-size: ;
        --tw-contain-layout: ;
        --tw-contain-paint: ;
        --tw-contain-style: ;
      }
      *,
      :before,
      :after {
        box-sizing: border-box;
        border-width: 0;
        border-style: solid;
        border-color: #e5e7eb;
      }
      :before,
      :after {
        --tw-content: "";
      }
      html,
      :host {
        line-height: 1.5;
        -webkit-text-size-adjust: 100%;
        -moz-tab-size: 4;
        -o-tab-size: 4;
        tab-size: 4;
        font-family:
          Figtree,
          ui-sans-serif,
          system-ui,
          sans-serif,
          "Apple Color Emoji",
          "Segoe UI Emoji",
          Segoe UI Symbol,
          "Noto Color Emoji";
        font-feature-settings: normal;
        font-variation-settings: normal;
        -webkit-tap-highlight-color: transparent;
      }
      body {
        margin: 0;
        line-height: inherit;
      }
      hr {
        height: 0;
        color: inherit;
        border-top-width: 1px;
      }
      abbr:where([title]) {
        -webkit-text-decoration: underline dotted;
        text-decoration: underline dotted;
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        font-size: inherit;
        font-weight: inherit;
      }
      a {
        color: inherit;
        text-decoration: inherit;
      }
      b,
      strong {
        font-weight: bolder;
      }
      code,
      kbd,
      samp,
      pre {
        font-family:
          ui-monospace,
          SFMono-Regular,
          Menlo,
          Monaco,
          Consolas,
          Liberation Mono,
          Courier New,
          monospace;
        font-feature-settings: normal;
        font-variation-settings: normal;
        font-size: 1em;
      }
      small {
        font-size: 80%;
      }
      sub,
      sup {
        font-size: 75%;
        line-height: 0;
        position: relative;
        vertical-align: baseline;
      }
      sub {
        bottom: -0.25em;
      }
      sup {
        top: -0.5em;
      }
      table {
        text-indent: 0;
        border-color: inherit;
        border-collapse: collapse;
      }
      button,
      input,
      optgroup,
      select,
      textarea {
        font-family: inherit;
        font-feature-settings: inherit;
        font-variation-settings: inherit;
        font-size: 100%;
        font-weight: inherit;
        line-height: inherit;
        letter-spacing: inherit;
        color: inherit;
        margin: 0;
        padding: 0;
      }
      button,
      select {
        text-transform: none;
      }
      button,
      input:where([type="button"]),
      input:where([type="reset"]),
      input:where([type="submit"]) {
        -webkit-appearance: button;
        background-color: transparent;
        background-image: none;
      }
      :-moz-focusring {
        outline: auto;
      }
      :-moz-ui-invalid {
        box-shadow: none;
      }
      progress {
        vertical-align: baseline;
      }
      ::-webkit-inner-spin-button,
      ::-webkit-outer-spin-button {
        height: auto;
      }
      [type="search"] {
        -webkit-appearance: textfield;
        outline-offset: -2px;
      }
      ::-webkit-search-decoration {
        -webkit-appearance: none;
      }
      ::-webkit-file-upload-button {
        -webkit-appearance: button;
        font: inherit;
      }
      summary {
        display: list-item;
      }
      blockquote,
      dl,
      dd,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      hr,
      figure,
      p,
      pre {
        margin: 0;
      }
      fieldset {
        margin: 0;
        padding: 0;
      }
      legend {
        padding: 0;
      }
      ol,
      ul,
      menu {
        list-style: none;
        margin: 0;
        padding: 0;
      }
      dialog {
        padding: 0;
      }
      textarea {
        resize: vertical;
      }
      input::-moz-placeholder,
      textarea::-moz-placeholder {
        opacity: 1;
        color: #9ca3af;
      }
      input::placeholder,
      textarea::placeholder {
        opacity: 1;
        color: #9ca3af;
      }
      button,
      [role="button"] {
        cursor: pointer;
      }
      :disabled {
        cursor: default;
      }
      img,
      svg,
      video,
      canvas,
      audio,
      iframe,
      embed,
      object {
        display: block;
        vertical-align: middle;
      }
      img,
      video {
        max-width: 100%;
        height: auto;
      }
      [hidden]:where(:not([hidden="until-found"])) {
        display: none;
      }
      .absolute {
        position: absolute;
      }
      .relative {
        position: relative;
      }
      .-bottom-16 {
        bottom: -4rem;
      }
      .-left-16 {
        left: -4rem;
      }
      .-left-20 {
        left: -5rem;
      }
      .top-0 {
        top: 0;
      }
      .z-0 {
        z-index: 0;
      }
      .\!row-span-1 {
        grid-row: span 1 / span 1 !important;
      }
      .-mx-3 {
        margin-left: -0.75rem;
        margin-right: -0.75rem;
      }
      .-ml-px {
        margin-left: -1px;
      }
      .ml-3 {
        margin-left: 0.75rem;
      }
      .mt-4 {
        margin-top: 1rem;
      }
      .mt-6 {
        margin-top: 1.5rem;
      }
      .flex {
        display: flex;
      }
      .inline-flex {
        display: inline-flex;
      }
      .table {
        display: table;
      }
      .grid {
        display: grid;
      }
      .\!hidden {
        display: none !important;
      }
      .hidden {
        display: none;
      }
      .aspect-video {
        aspect-ratio: 16 / 9;
      }
      .size-12 {
        width: 3rem;
        height: 3rem;
      }
      .size-5 {
        width: 1.25rem;
        height: 1.25rem;
      }
      .size-6 {
        width: 1.5rem;
        height: 1.5rem;
      }
      .h-12 {
        height: 3rem;
      }
      .h-40 {
        height: 10rem;
      }
      .h-5 {
        height: 1.25rem;
      }
      .h-full {
        height: 100%;
      }
      .min-h-screen {
        min-height: 100vh;
      }
      .w-5 {
        width: 1.25rem;
      }
      .w-\[calc\(100\%_\+_8rem\)\] {
        width: calc(100% + 8rem);
      }
      .w-auto {
        width: auto;
      }
      .w-full {
        width: 100%;
      }
      .max-w-2xl {
        max-width: 42rem;
      }
      .max-w-\[877px\] {
        max-width: 877px;
      }
      .flex-1 {
        flex: 1 1 0%;
      }
      .shrink-0 {
        flex-shrink: 0;
      }
      .transform {
        transform: translate(var(--tw-translate-x), var(--tw-translate-y))
          rotate(var(--tw-rotate)) skew(var(--tw-skew-x))
          skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x))
          scaleY(var(--tw-scale-y));
      }
      .cursor-default {
        cursor: default;
      }
      .resize {
        resize: both;
      }
      .grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .\!flex-row {
        flex-direction: row !important;
      }
      .flex-col {
        flex-direction: column;
      }
      .items-start {
        align-items: flex-start;
      }
      .items-center {
        align-items: center;
      }
      .items-stretch {
        align-items: stretch;
      }
      .justify-end {
        justify-content: flex-end;
      }
      .justify-center {
        justify-content: center;
      }
      .justify-between {
        justify-content: space-between;
      }
      .justify-items-center {
        justify-items: center;
      }
      .gap-2 {
        gap: 0.5rem;
      }
      .gap-4 {
        gap: 1rem;
      }
      .gap-6 {
        gap: 1.5rem;
      }
      .self-center {
        align-self: center;
      }
      .overflow-hidden {
        overflow: hidden;
      }
      .rounded-\[10px\] {
        border-radius: 10px;
      }
      .rounded-full {
        border-radius: 9999px;
      }
      .rounded-lg {
        border-radius: 0.5rem;
      }
      .rounded-md {
        border-radius: 0.375rem;
      }
      .rounded-sm {
        border-radius: 0.125rem;
      }
      .rounded-l-md {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
      }
      .rounded-r-md {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
      }
      .border {
        border-width: 1px;
      }
      .border-gray-300 {
        --tw-border-opacity: 1;
        border-color: rgb(209 213 219 / var(--tw-border-opacity, 1));
      }
      .bg-\[\#18B69C\]\/10 {
        background-color: #18b69c1a;
      }
      .bg-gray-50 {
        --tw-bg-opacity: 1;
        background-color: rgb(249 250 251 / var(--tw-bg-opacity, 1));
      }
      .bg-white {
        --tw-bg-opacity: 1;
        background-color: rgb(255 255 255 / var(--tw-bg-opacity, 1));
      }
      .bg-gradient-to-b {
        background-image: linear-gradient(to bottom, var(--tw-gradient-stops));
      }
      .from-transparent {
        --tw-gradient-from: transparent var(--tw-gradient-from-position);
        --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
      }
      .via-white {
        --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
        --tw-gradient-stops: var(--tw-gradient-from),
          #fff var(--tw-gradient-via-position), var(--tw-gradient-to);
      }
      .to-white {
        --tw-gradient-to: #fff var(--tw-gradient-to-position);
      }
      .to-zinc-900 {
        --tw-gradient-to: #18181b var(--tw-gradient-to-position);
      }
      .stroke-\[\#18B69C\] {
        stroke: #18b69c;
      }
      .object-cover {
        -o-object-fit: cover;
        object-fit: cover;
      }
      .object-top {
        -o-object-position: top;
        object-position: top;
      }
      .p-6 {
        padding: 1.5rem;
      }
      .px-2 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
      }
      .px-3 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
      }
      .px-4 {
        padding-left: 1rem;
        padding-right: 1rem;
      }
      .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
      }
      .py-10 {
        padding-top: 2.5rem;
        padding-bottom: 2.5rem;
      }
      .py-16 {
        padding-top: 4rem;
        padding-bottom: 4rem;
      }
      .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
      }
      .pt-3 {
        padding-top: 0.75rem;
      }
      .text-center {
        text-align: center;
      }
      .font-sans {
        font-family:
          Figtree,
          ui-sans-serif,
          system-ui,
          sans-serif,
          "Apple Color Emoji",
          "Segoe UI Emoji",
          Segoe UI Symbol,
          "Noto Color Emoji";
      }
      .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
      }
      .text-sm\/relaxed {
        font-size: 0.875rem;
        line-height: 1.625;
      }
      .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
      }
      .font-medium {
        font-weight: 500;
      }
      .font-semibold {
        font-weight: 600;
      }
      .leading-5 {
        line-height: 1.25rem;
      }
      .text-black {
        --tw-text-opacity: 1;
        color: rgb(0 0 0 / var(--tw-text-opacity, 1));
      }
      .text-black\/50 {
        color: #00000080;
      }
      .text-gray-500 {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity, 1));
      }
      .text-gray-700 {
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity, 1));
      }
      .text-white {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity, 1));
      }
      .underline {
        text-decoration-line: underline;
      }
      .antialiased {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      .shadow-\[0px_14px_34px_0px_rgba\(0\,0\,0\,0\.08\)\] {
        --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, 0.08);
        --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
          var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
      }
      .shadow-sm {
        --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
          var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
      }
      .ring-1 {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0
          var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
          calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
          var(--tw-shadow, 0 0 #0000);
      }
      .ring-black {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity, 1));
      }
      .ring-gray-300 {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(209 213 219 / var(--tw-ring-opacity, 1));
      }
      .ring-transparent {
        --tw-ring-color: transparent;
      }
      .ring-white {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1));
      }
      .ring-white\/\[0\.05\] {
        --tw-ring-color: rgb(255 255 255 / 0.05);
      }
      .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.06\)\] {
        --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.06));
        filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast)
          var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert)
          var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
      }
      .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.25\)\] {
        --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, 0.25));
        filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast)
          var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert)
          var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
      }
      .filter {
        filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast)
          var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert)
          var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);
      }
      .transition {
        transition-property:
          color,
          background-color,
          border-color,
          text-decoration-color,
          fill,
          stroke,
          opacity,
          box-shadow,
          transform,
          filter,
          -webkit-backdrop-filter;
        transition-property: color, background-color, border-color,
          text-decoration-color, fill, stroke, opacity, box-shadow, transform,
          filter, backdrop-filter;
        transition-property:
          color,
          background-color,
          border-color,
          text-decoration-color,
          fill,
          stroke,
          opacity,
          box-shadow,
          transform,
          filter,
          backdrop-filter,
          -webkit-backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 0.15s;
      }
      .duration-150 {
        transition-duration: 0.15s;
      }
      .duration-300 {
        transition-duration: 0.3s;
      }
      .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      }
      .selection\:bg-\[\#18B69C\] *::-moz-selection {
        --tw-bg-opacity: 1;
        background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1));
      }
      .selection\:bg-\[\#18B69C\] *::selection {
        --tw-bg-opacity: 1;
        background-color: rgb(24 182 156 / var(--tw-bg-opacity, 1));
      }
      .selection\:text-white *::-moz-selection {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity, 1));
      }
      .selection\:text-white *::selection {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity, 1));
      }
      .selection\:bg-\[\#18B69C\]::-moz-selection {
        --tw-bg-opacity: 1;
        background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1));
      }
      .selection\:bg-\[\#18B69C\]::selection {
        --tw-bg-opacity: 1;
        background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1));
      }
      .selection\:text-white::-moz-selection {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity, 1));
      }
      .selection\:text-white::selection {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity, 1));
      }
      .hover\:text-black:hover {
        --tw-text-opacity: 1;
        color: rgb(0 0 0 / var(--tw-text-opacity, 1));
      }
      .hover\:text-black\/70:hover {
        color: #000000b3;
      }
      .hover\:text-gray-400:hover {
        --tw-text-opacity: 1;
        color: rgb(156 163 175 / var(--tw-text-opacity, 1));
      }
      .hover\:text-gray-500:hover {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity, 1));
      }
      .hover\:ring-black\/20:hover {
        --tw-ring-color: rgb(0 0 0 / 0.2);
      }
      .focus\:z-10:focus {
        z-index: 10;
      }
      .focus\:border-blue-300:focus {
        --tw-border-opacity: 1;
        border-color: rgb(147 197 253 / var(--tw-border-opacity, 1));
      }
      .focus\:outline-none:focus {
        outline: 2px solid transparent;
        outline-offset: 2px;
      }
      .focus\:ring:focus {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0
          var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
          calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
          var(--tw-shadow, 0 0 #0000);
      }
      .focus-visible\:ring-1:focus-visible {
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0
          var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
          calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
          var(--tw-shadow, 0 0 #0000);
      }
      .focus-visible\:ring-\[\#18B69C\]:focus-visible {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1));
      }
      .active\:bg-gray-100:active {
        --tw-bg-opacity: 1;
        background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1));
      }
      .active\:text-gray-500:active {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity, 1));
      }
      .active\:text-gray-700:active {
        --tw-text-opacity: 1;
        color: rgb(55 65 81 / var(--tw-text-opacity, 1));
      }
      @media (min-width: 640px) {
        .sm\:flex {
          display: flex;
        }
        .sm\:hidden {
          display: none;
        }
        .sm\:size-16 {
          width: 4rem;
          height: 4rem;
        }
        .sm\:size-6 {
          width: 1.5rem;
          height: 1.5rem;
        }
        .sm\:flex-1 {
          flex: 1 1 0%;
        }
        .sm\:items-center {
          align-items: center;
        }
        .sm\:justify-between {
          justify-content: space-between;
        }
        .sm\:pt-5 {
          padding-top: 1.25rem;
        }
      }
      @media (min-width: 768px) {
        .md\:row-span-3 {
          grid-row: span 3 / span 3;
        }
      }
      @media (min-width: 1024px) {
        .lg\:col-start-2 {
          grid-column-start: 2;
        }
        .lg\:h-16 {
          height: 4rem;
        }
        .lg\:max-w-7xl {
          max-width: 80rem;
        }
        .lg\:grid-cols-2 {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .lg\:grid-cols-3 {
          grid-template-columns: repeat(3, minmax(0, 1fr));
        }
        .lg\:flex-col {
          flex-direction: column;
        }
        .lg\:items-end {
          align-items: flex-end;
        }
        .lg\:justify-center {
          justify-content: center;
        }
        .lg\:gap-8 {
          gap: 2rem;
        }
        .lg\:p-10 {
          padding: 2.5rem;
        }
        .lg\:pb-10 {
          padding-bottom: 2.5rem;
        }
        .lg\:pt-0 {
          padding-top: 0;
        }
        .lg\:text-\[\#18B69C\] {
          --tw-text-opacity: 1;
          color: rgb(255 45 32 / var(--tw-text-opacity, 1));
        }
      }
      .rtl\:flex-row-reverse:where([dir="rtl"], [dir="rtl"] *) {
        flex-direction: row-reverse;
      }
      @media (prefers-color-scheme: dark) {
        .dark\:block {
          display: block;
        }
        .dark\:hidden {
          display: none;
        }
        .dark\:border-gray-600 {
          --tw-border-opacity: 1;
          border-color: rgb(75 85 99 / var(--tw-border-opacity, 1));
        }
        .dark\:bg-black {
          --tw-bg-opacity: 1;
          background-color: rgb(0 0 0 / var(--tw-bg-opacity, 1));
        }
        .dark\:bg-gray-800 {
          --tw-bg-opacity: 1;
          background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1));
        }
        .dark\:bg-zinc-900 {
          --tw-bg-opacity: 1;
          background-color: rgb(24 24 27 / var(--tw-bg-opacity, 1));
        }
        .dark\:via-zinc-900 {
          --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
          --tw-gradient-stops: var(--tw-gradient-from),
            #18181b var(--tw-gradient-via-position), var(--tw-gradient-to);
        }
        .dark\:to-zinc-900 {
          --tw-gradient-to: #18181b var(--tw-gradient-to-position);
        }
        .dark\:text-gray-300 {
          --tw-text-opacity: 1;
          color: rgb(209 213 219 / var(--tw-text-opacity, 1));
        }
        .dark\:text-gray-400 {
          --tw-text-opacity: 1;
          color: rgb(156 163 175 / var(--tw-text-opacity, 1));
        }
        .dark\:text-gray-600 {
          --tw-text-opacity: 1;
          color: rgb(75 85 99 / var(--tw-text-opacity, 1));
        }
        .dark\:text-white {
          --tw-text-opacity: 1;
          color: rgb(255 255 255 / var(--tw-text-opacity, 1));
        }
        .dark\:text-white\/50 {
          color: #ffffff80;
        }
        .dark\:text-white\/70 {
          color: #ffffffb3;
        }
        .dark\:ring-zinc-800 {
          --tw-ring-opacity: 1;
          --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity, 1));
        }
        .dark\:hover\:text-gray-300:hover {
          --tw-text-opacity: 1;
          color: rgb(209 213 219 / var(--tw-text-opacity, 1));
        }
        .dark\:hover\:text-white:hover {
          --tw-text-opacity: 1;
          color: rgb(255 255 255 / var(--tw-text-opacity, 1));
        }
        .dark\:hover\:text-white\/70:hover {
          color: #ffffffb3;
        }
        .dark\:hover\:text-white\/80:hover {
          color: #fffc;
        }
        .dark\:hover\:ring-zinc-700:hover {
          --tw-ring-opacity: 1;
          --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity, 1));
        }
        .dark\:focus\:border-blue-700:focus {
          --tw-border-opacity: 1;
          border-color: rgb(29 78 216 / var(--tw-border-opacity, 1));
        }
        .dark\:focus\:border-blue-800:focus {
          --tw-border-opacity: 1;
          border-color: rgb(30 64 175 / var(--tw-border-opacity, 1));
        }
        .dark\:focus-visible\:ring-\[\#18B69C\]:focus-visible {
          --tw-ring-opacity: 1;
          --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1));
        }
        .dark\:focus-visible\:ring-white:focus-visible {
          --tw-ring-opacity: 1;
          --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1));
        }
        .dark\:active\:bg-gray-700:active {
          --tw-bg-opacity: 1;
          background-color: rgb(55 65 81 / var(--tw-bg-opacity, 1));
        }
        .dark\:active\:text-gray-300:active {
          --tw-text-opacity: 1;
          color: rgb(209 213 219 / var(--tw-text-opacity, 1));
        }
      }
    </style>
    @endif
  </head>
  <body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
      <img
        id="background"
        class="absolute -left-20 top-0 max-w-[877px]"
        src="{{ asset('images/background.svg') }}"
        alt="Simpede background"
      />
      <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#18B69C] selection:text-white"
      >
        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
          <header
            class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
          >
            <div class="flex lg:justify-center lg:col-start-2">
              <svg
                width="360px"
                viewBox="0 0 210 39"
                xmlns="http://www.w3.org/2000/svg"
              >
                <defs>
                  <radialGradient
                    cx="-4.619%"
                    cy="6.646%"
                    fx="-4.619%"
                    fy="6.646%"
                    r="101.342%"
                    gradientTransform="matrix(.8299 .53351 -.5579 .79363 .03 .038)"
                    id="a"
                  >
                    <stop stop-color="#00FFB4" offset="0%"></stop>
                    <stop stop-color="#00E1FF" offset="100%"></stop>
                  </radialGradient>
                </defs>
                <g
                  id="svgGroup"
                  stroke-linecap="round"
                  fill-rule="nonzero"
                  fill="url(#a)"
                >
                  <path
                    transform="translate(4.000000, 3.750000)"
                    d="M 14.94 16.605 L 12.69 17.1 A 592.831 592.831 0 0 1 10.409 17.582 Q 9.02 17.872 7.83 18.113 A 23.986 23.986 0 0 1 6.066 18.405 Q 5.189 18.515 4.406 18.535 A 13.535 13.535 0 0 1 4.05 18.54 A 9.927 9.927 0 0 1 2.928 18.481 Q 2.392 18.42 1.948 18.296 A 3.879 3.879 0 0 1 1.058 17.933 Q 0 17.325 0 15.84 Q 0 15.337 0.15 14.683 A 9.133 9.133 0 0 1 0.27 14.22 Q 1.133 11.371 4.772 8.19 A 30.532 30.532 0 0 1 5.085 7.92 A 34.195 34.195 0 0 1 10.214 4.344 A 38.371 38.371 0 0 1 11.025 3.893 A 38.163 38.163 0 0 1 17.139 1.227 A 35.142 35.142 0 0 1 17.663 1.058 Q 21.015 0 23.94 0 Q 25.636 0 26.808 0.563 A 4.285 4.285 0 0 1 27.518 0.99 A 3.139 3.139 0 0 1 28.824 3.268 A 4.079 4.079 0 0 1 28.845 3.69 A 5.117 5.117 0 0 1 28.581 5.269 Q 28.3 6.137 27.72 7.065 Q 27.405 7.515 27.18 7.515 Q 27.104 7.515 27.028 7.403 A 0.704 0.704 0 0 1 27 7.358 Q 26.91 7.2 26.91 7.02 A 0.3 0.3 0 0 1 26.911 6.994 Q 26.915 6.949 26.931 6.87 A 2.924 2.924 0 0 1 26.933 6.863 Q 26.953 6.762 26.991 6.607 A 11.844 11.844 0 0 1 27 6.57 A 7.196 7.196 0 0 0 27.291 5.384 A 5.837 5.837 0 0 0 27.36 4.5 A 3.514 3.514 0 0 0 27.246 3.578 A 2.43 2.43 0 0 0 26.303 2.205 Q 25.245 1.44 23.265 1.62 Q 20.572 1.9 17.28 3.077 A 42.204 42.204 0 0 0 15.345 3.825 Q 12.33 5.085 9.653 6.795 A 30.156 30.156 0 0 0 6.918 8.754 A 23.671 23.671 0 0 0 5.063 10.418 Q 3.418 12.062 2.655 13.723 A 7.902 7.902 0 0 0 2.43 14.265 A 1.652 1.652 0 0 0 2.285 14.713 A 2.291 2.291 0 0 0 2.25 15.12 A 1.442 1.442 0 0 0 3.139 16.47 Q 3.83 16.82 5.058 16.898 A 11.834 11.834 0 0 0 5.805 16.92 Q 7.515 16.92 9.563 16.56 A 160.362 160.362 0 0 0 11.19 16.265 Q 11.906 16.131 12.686 15.98 A 277.749 277.749 0 0 0 14.31 15.66 L 15.885 15.345 A 9.735 9.735 0 0 1 17.22 15.213 A 8.793 8.793 0 0 1 17.46 15.21 A 5.756 5.756 0 0 1 18.381 15.279 Q 18.864 15.358 19.258 15.525 A 2.849 2.849 0 0 1 19.755 15.795 Q 20.564 16.348 20.608 17.304 A 2.42 2.42 0 0 1 20.61 17.415 Q 20.61 18.36 19.8 19.665 Q 19.035 20.88 18 21.983 A 23.845 23.845 0 0 1 16.093 23.795 A 26.767 26.767 0 0 1 15.705 24.12 Q 13.14 26.19 10.215 27.405 A 17.03 17.03 0 0 1 7.542 28.277 A 12.628 12.628 0 0 1 4.68 28.62 A 4.088 4.088 0 0 1 4.062 28.577 Q 3.388 28.473 2.993 28.125 Q 2.43 27.63 2.43 26.775 A 3.087 3.087 0 0 1 2.546 25.959 Q 2.643 25.606 2.82 25.232 A 5.73 5.73 0 0 1 2.925 25.02 A 5.941 5.941 0 0 1 3.797 23.785 A 7.301 7.301 0 0 1 4.32 23.265 Q 4.59 23.04 4.77 22.995 A 0.333 0.333 0 0 1 4.889 23.016 A 0.299 0.299 0 0 1 4.995 23.085 A 0.115 0.115 0 0 1 5.019 23.122 Q 5.034 23.159 5.038 23.218 A 0.668 0.668 0 0 1 5.04 23.265 Q 5.04 23.58 4.635 23.985 A 8.238 8.238 0 0 0 4.091 24.603 Q 3.375 25.512 3.375 26.19 A 1.077 1.077 0 0 0 3.588 26.828 A 1.627 1.627 0 0 0 3.825 27.09 Q 4.275 27.495 4.86 27.45 A 13.939 13.939 0 0 0 8.018 26.944 A 17.005 17.005 0 0 0 9.495 26.46 Q 11.88 25.56 13.95 23.963 A 15.005 15.005 0 0 0 17.155 20.616 A 14.187 14.187 0 0 0 17.37 20.295 Q 18.348 18.872 18.36 17.801 A 2.373 2.373 0 0 0 18.36 17.775 A 1.521 1.521 0 0 0 18.24 17.149 Q 17.949 16.498 16.946 16.398 A 3.91 3.91 0 0 0 16.56 16.38 A 3.535 3.535 0 0 0 16.267 16.393 Q 16.118 16.406 15.952 16.43 A 6.183 6.183 0 0 0 15.84 16.448 Q 15.435 16.515 14.94 16.605 Z"
                    vector-effect="non-scaling-stroke"
                  />
                </g>
                <g id="svgGroup" fill-rule="evenodd" fill="currentColor">
                  <path
                    fill="currentColor"
                    transform="translate(47.0000, 5.0000)"
                    d="M 19.548 20.556 L 21.996 9 L 27.18 9 L 24.588 21.24 Q 24.516 21.564 24.48 21.834 A 4.208 4.208 0 0 0 24.444 22.374 A 4.589 4.589 0 0 0 24.444 22.392 A 2.389 2.389 0 0 0 24.47 22.755 Q 24.498 22.941 24.559 23.088 A 0.891 0.891 0 0 0 24.786 23.418 A 0.993 0.993 0 0 0 25.098 23.602 Q 25.419 23.724 25.92 23.724 A 2.384 2.384 0 0 0 27.16 23.367 Q 27.491 23.169 27.808 22.862 A 4.454 4.454 0 0 0 27.828 22.842 A 4.91 4.91 0 0 0 28.808 21.46 A 6.368 6.368 0 0 0 29.154 20.576 L 31.608 9 L 36.792 9 L 36.396 10.872 Q 37.296 9.828 38.376 9.324 Q 39.456 8.82 40.788 8.82 Q 42.372 8.82 43.29 9.594 A 3.186 3.186 0 0 1 44.106 10.672 Q 44.366 11.215 44.496 11.916 A 9.321 9.321 0 0 1 45.351 10.789 Q 45.88 10.198 46.458 9.79 A 5.409 5.409 0 0 1 46.728 9.612 A 5.099 5.099 0 0 1 49.213 8.863 A 6.16 6.16 0 0 1 49.5 8.856 A 5.591 5.591 0 0 1 50.685 8.974 Q 51.44 9.138 52.007 9.529 A 3.195 3.195 0 0 1 52.452 9.9 A 3.348 3.348 0 0 1 53.282 11.322 Q 53.443 11.851 53.483 12.488 A 6.933 6.933 0 0 1 53.496 12.924 Q 53.496 13.568 53.377 14.396 A 16.858 16.858 0 0 1 53.298 14.886 Q 53.1 16.02 52.524 18.36 A 120.481 120.481 0 0 0 52.311 19.211 Q 52.051 20.261 51.937 20.826 A 12.054 12.054 0 0 0 51.912 20.952 A 10.388 10.388 0 0 0 51.83 21.442 Q 51.799 21.662 51.784 21.854 A 4.477 4.477 0 0 0 51.768 22.212 A 2.528 2.528 0 0 0 51.802 22.638 Q 51.84 22.864 51.924 23.043 A 1.125 1.125 0 0 0 52.128 23.346 A 1.133 1.133 0 0 0 52.612 23.641 Q 52.871 23.724 53.208 23.724 Q 54.108 23.724 54.756 23.112 Q 55.383 22.52 56.177 20.684 A 24.298 24.298 0 0 0 56.232 20.556 L 56.233 20.556 L 58.968 7.668 L 64.152 7.668 L 63.576 10.368 Q 64.476 9.612 65.52 9.216 Q 66.564 8.82 67.788 8.82 A 5.154 5.154 0 0 1 69.122 8.983 A 3.547 3.547 0 0 1 71.064 10.26 A 4.647 4.647 0 0 1 71.787 11.656 Q 72.002 12.304 72.099 13.096 A 11.585 11.585 0 0 1 72.18 14.508 A 21.294 21.294 0 0 1 71.849 18.371 Q 71.417 20.711 70.423 22.596 A 12.501 12.501 0 0 1 69.822 23.616 A 8.487 8.487 0 0 1 67.803 25.81 Q 65.912 27.216 63.324 27.216 A 6.803 6.803 0 0 1 62.513 27.171 Q 62.099 27.121 61.748 27.016 A 3.463 3.463 0 0 1 61.398 26.892 A 2.551 2.551 0 0 1 60.782 26.532 A 2.063 2.063 0 0 1 60.264 25.92 L 58.392 34.704 L 52.956 36 L 55.236 25.258 A 8.533 8.533 0 0 1 54.954 25.56 A 5.54 5.54 0 0 1 53.005 26.864 A 5.388 5.388 0 0 1 51.048 27.216 Q 49.407 27.216 48.362 26.488 A 3.431 3.431 0 0 1 47.916 26.118 A 3.653 3.653 0 0 1 46.891 24.153 A 5.306 5.306 0 0 1 46.8 23.148 A 5.289 5.289 0 0 1 46.8 23.133 Q 46.802 22.669 46.885 22.042 A 15.693 15.693 0 0 1 46.962 21.528 Q 47.118 20.592 47.591 18.589 A 138.268 138.268 0 0 1 47.628 18.432 Q 48.132 16.38 48.276 15.48 A 14.243 14.243 0 0 0 48.361 14.87 Q 48.394 14.583 48.409 14.334 A 6.305 6.305 0 0 0 48.42 13.968 A 4.024 4.024 0 0 0 48.392 13.472 Q 48.36 13.22 48.294 13.013 A 1.555 1.555 0 0 0 48.096 12.6 A 1.054 1.054 0 0 0 47.328 12.145 A 1.593 1.593 0 0 0 47.124 12.132 A 1.746 1.746 0 0 0 46.149 12.439 Q 45.825 12.652 45.522 13.014 A 5.09 5.09 0 0 0 44.948 13.877 Q 44.587 14.549 44.316 15.444 L 41.868 27 L 36.684 27 L 39.312 14.58 Q 39.384 14.364 39.402 14.148 A 5.158 5.158 0 0 0 39.417 13.879 A 6.46 6.46 0 0 0 39.42 13.68 A 2.932 2.932 0 0 0 39.386 13.219 Q 39.321 12.812 39.132 12.528 A 1.02 1.02 0 0 0 38.874 12.257 Q 38.659 12.104 38.371 12.097 A 1.153 1.153 0 0 0 38.34 12.096 A 1.963 1.963 0 0 0 37.164 12.494 A 3.036 3.036 0 0 0 36.648 12.978 Q 36.061 13.664 35.647 14.774 A 10.18 10.18 0 0 0 35.424 15.444 L 32.976 27 L 27.792 27 L 28.244 24.871 A 8.216 8.216 0 0 1 27.576 25.524 Q 25.632 27.216 23.112 27.216 A 4.606 4.606 0 0 1 21.918 27.07 A 3.304 3.304 0 0 1 20.286 26.082 A 3.724 3.724 0 0 1 19.486 24.618 Q 19.317 24.048 19.274 23.364 A 7.59 7.59 0 0 1 19.26 22.896 A 7.318 7.318 0 0 1 19.276 22.43 Q 19.294 22.15 19.332 21.834 A 13.525 13.525 0 0 1 19.436 21.137 A 17.066 17.066 0 0 1 19.548 20.556 Z M 84.886 16.769 A 6.624 6.624 0 0 0 86.76 12.132 Q 86.76 10.368 85.77 9.522 A 3.032 3.032 0 0 0 84.893 9.008 Q 84.444 8.833 83.889 8.751 A 7.405 7.405 0 0 0 82.8 8.676 A 9.476 9.476 0 0 0 82.478 8.682 A 7.931 7.931 0 0 0 78.642 9.774 A 8.434 8.434 0 0 0 76.82 11.24 A 10.919 10.919 0 0 0 75.456 13.032 A 14.955 14.955 0 0 0 74.65 14.578 A 18.185 18.185 0 0 0 73.728 17.136 Q 73.08 19.44 73.08 21.492 A 10.02 10.02 0 0 0 73.122 22.428 Q 73.325 24.584 74.502 25.776 A 4.239 4.239 0 0 0 75.48 26.512 Q 76.758 27.216 78.696 27.216 Q 81.612 27.216 84.06 25.578 A 11.301 11.301 0 0 0 85.026 24.852 Q 86.035 24.008 86.98 22.849 A 21.517 21.517 0 0 0 87.183 22.593 A 7.634 7.634 0 0 0 87.46 23.944 A 4.975 4.975 0 0 0 88.398 25.704 A 4.076 4.076 0 0 0 90.368 27.004 A 5.299 5.299 0 0 0 91.908 27.216 Q 93.492 27.216 94.824 26.388 Q 95.584 25.916 96.262 25.174 A 9.869 9.869 0 0 0 97.236 23.904 A 4.675 4.675 0 0 0 97.471 24.85 A 3.257 3.257 0 0 0 98.37 26.19 A 3.126 3.126 0 0 0 99.716 26.881 A 4.388 4.388 0 0 0 100.764 27 A 7.94 7.94 0 0 0 100.943 26.998 A 6.182 6.182 0 0 0 105.102 25.38 A 7.963 7.963 0 0 0 105.835 24.614 A 4.536 4.536 0 0 0 106.65 25.776 A 4.239 4.239 0 0 0 107.628 26.512 Q 108.906 27.216 110.844 27.216 Q 113.76 27.216 116.208 25.578 A 11.301 11.301 0 0 0 117.174 24.852 Q 119.074 23.263 120.744 20.556 L 119.52 20.556 A 26.451 26.451 0 0 1 119.262 20.845 Q 117.583 22.699 116.262 23.418 Q 114.84 24.192 113.148 24.192 A 6.155 6.155 0 0 1 113.041 24.191 Q 111.652 24.167 111.114 23.508 A 1.708 1.708 0 0 1 110.931 23.23 Q 110.556 22.526 110.556 21.168 Q 110.556 20.952 110.574 20.646 L 110.628 19.728 Q 114.012 19.548 116.46 17.334 A 9.154 9.154 0 0 0 117.034 16.769 A 6.624 6.624 0 0 0 118.908 12.132 Q 118.908 10.368 117.918 9.522 A 3.032 3.032 0 0 0 117.041 9.008 Q 116.592 8.833 116.037 8.751 A 7.405 7.405 0 0 0 114.948 8.676 A 9.476 9.476 0 0 0 114.626 8.682 A 7.931 7.931 0 0 0 110.79 9.774 A 8.434 8.434 0 0 0 108.968 11.24 A 10.919 10.919 0 0 0 107.604 13.032 A 14.955 14.955 0 0 0 106.798 14.578 A 18.185 18.185 0 0 0 105.876 17.136 Q 105.228 19.44 105.228 21.492 A 10.02 10.02 0 0 0 105.27 22.428 A 7.021 7.021 0 0 0 105.317 22.836 A 4.529 4.529 0 0 1 105.264 22.896 A 3.05 3.05 0 0 1 104.825 23.296 A 2.068 2.068 0 0 1 103.572 23.724 Q 103.071 23.724 102.75 23.602 A 0.993 0.993 0 0 1 102.438 23.418 A 0.891 0.891 0 0 1 102.211 23.088 Q 102.15 22.941 102.122 22.755 A 2.389 2.389 0 0 1 102.096 22.392 A 4.589 4.589 0 0 1 102.096 22.374 A 4.208 4.208 0 0 1 102.132 21.834 Q 102.168 21.564 102.24 21.24 L 106.38 1.8 L 101.052 2.52 L 99.288 10.8 L 99.288 10.656 A 1.938 1.938 0 0 0 99.288 10.606 Q 99.266 9.778 98.532 9.306 Q 98.011 8.971 97.182 8.867 A 6.52 6.52 0 0 0 96.372 8.82 Q 94.284 8.82 92.52 9.954 Q 90.756 11.088 89.424 13.212 A 14.857 14.857 0 0 0 88.914 14.137 A 16.66 16.66 0 0 0 87.732 17.208 A 17.945 17.945 0 0 0 87.41 18.563 A 14.796 14.796 0 0 0 87.135 20.823 A 26.451 26.451 0 0 1 87.114 20.845 Q 85.435 22.699 84.114 23.418 Q 82.692 24.192 81 24.192 A 6.155 6.155 0 0 1 80.893 24.191 Q 79.504 24.167 78.966 23.508 A 1.708 1.708 0 0 1 78.783 23.23 Q 78.408 22.526 78.408 21.168 Q 78.408 20.952 78.426 20.646 L 78.48 19.728 Q 81.864 19.548 84.312 17.334 A 9.154 9.154 0 0 0 84.886 16.769 Z M 6.333 2.31 A 5.447 5.447 0 0 0 4.5 6.444 A 5.38 5.38 0 0 0 4.61 7.523 A 6.211 6.211 0 0 0 5.166 9.09 A 6.874 6.874 0 0 0 5.538 9.725 Q 6.314 10.918 7.992 12.708 A 43.845 43.845 0 0 1 8.776 13.586 Q 10.501 15.572 11.124 16.848 Q 11.88 18.396 11.88 20.088 Q 11.88 20.963 11.697 21.695 A 4.385 4.385 0 0 1 10.728 23.58 A 3.716 3.716 0 0 1 9.156 24.645 A 4.383 4.383 0 0 1 7.704 24.876 Q 6.12 24.876 5.184 23.904 A 3.22 3.22 0 0 1 4.415 22.6 A 3.997 3.997 0 0 1 4.248 21.42 A 3.966 3.966 0 0 1 4.267 21.035 A 2.892 2.892 0 0 1 5.418 18.936 A 3.833 3.833 0 0 1 5.678 18.753 Q 6.322 18.337 7.155 18.163 A 6.356 6.356 0 0 1 8.46 18.036 A 2.887 2.887 0 0 0 8.44 17.831 A 2.201 2.201 0 0 0 7.524 16.29 Q 6.66 15.66 5.292 15.66 Q 3.096 15.66 1.548 17.316 A 5.527 5.527 0 0 0 0.256 19.613 A 7.113 7.113 0 0 0 0 21.564 A 7.667 7.667 0 0 0 0.05 22.454 A 5.274 5.274 0 0 0 2.052 26.136 A 6.492 6.492 0 0 0 3.102 26.81 Q 4.936 27.756 7.632 27.756 A 13.826 13.826 0 0 0 10.06 27.552 A 9.945 9.945 0 0 0 14.904 25.308 A 7.844 7.844 0 0 0 17.288 21.79 A 9.559 9.559 0 0 0 17.748 18.756 Q 17.748 16.524 16.848 14.706 Q 15.948 12.888 13.104 10.404 A 32.017 32.017 0 0 1 12.172 9.549 Q 10.792 8.229 10.296 7.362 Q 9.648 6.228 9.648 4.968 Q 9.648 4.412 9.762 3.944 A 2.834 2.834 0 0 1 10.53 2.556 A 2.785 2.785 0 0 1 10.68 2.42 Q 11.21 1.971 11.954 1.799 A 4.464 4.464 0 0 1 12.96 1.692 Q 14.256 1.692 14.94 2.322 Q 15.624 2.952 15.624 4.104 Q 15.624 5.04 15.174 5.904 A 3.843 3.843 0 0 1 14.867 6.402 A 2.947 2.947 0 0 1 14.004 7.2 A 2.326 2.326 0 0 0 14.194 7.406 A 1.863 1.863 0 0 0 14.742 7.776 Q 15.156 7.956 15.66 7.956 A 3.323 3.323 0 0 0 15.925 7.946 A 2.58 2.58 0 0 0 17.802 6.948 A 3.292 3.292 0 0 0 17.909 6.807 Q 18.329 6.223 18.498 5.449 A 5.287 5.287 0 0 0 18.612 4.32 A 5.182 5.182 0 0 0 18.582 3.752 A 3.606 3.606 0 0 0 17.082 1.116 A 4.965 4.965 0 0 0 15.971 0.513 Q 15.27 0.236 14.408 0.109 A 10.908 10.908 0 0 0 12.816 0 A 11.88 11.88 0 0 0 10.871 0.154 A 8.782 8.782 0 0 0 6.894 1.836 A 7.639 7.639 0 0 0 6.333 2.31 Z M 62.964 13.176 L 60.84 23.256 Q 60.984 23.652 61.344 23.868 Q 61.704 24.084 62.208 24.084 Q 64.187 24.084 65.494 21.865 A 8.901 8.901 0 0 0 65.862 21.168 A 14.064 14.064 0 0 0 67.037 17.267 A 18.675 18.675 0 0 0 67.248 14.4 A 8.167 8.167 0 0 0 67.214 13.627 Q 67.136 12.809 66.88 12.289 A 2.189 2.189 0 0 0 66.816 12.168 A 1.464 1.464 0 0 0 66.306 11.629 Q 66.027 11.459 65.661 11.422 A 2.114 2.114 0 0 0 65.448 11.412 A 1.931 1.931 0 0 0 64.739 11.553 Q 64.432 11.674 64.116 11.898 A 3.982 3.982 0 0 0 63.147 12.89 A 4.735 4.735 0 0 0 62.964 13.176 Z M 97.2 20.736 L 97.2 20.556 L 98.964 12.312 A 1.849 1.849 0 0 0 98.815 11.846 A 1.459 1.459 0 0 0 98.478 11.394 A 1.294 1.294 0 0 0 97.848 11.086 A 1.847 1.847 0 0 0 97.488 11.052 Q 95.508 11.052 93.978 14.364 A 16.914 16.914 0 0 0 92.741 18.067 A 14.18 14.18 0 0 0 92.448 20.916 Q 92.448 22.32 92.844 23.022 A 1.313 1.313 0 0 0 93.73 23.669 A 2.257 2.257 0 0 0 94.248 23.724 Q 95.046 23.724 95.816 23.059 A 4.291 4.291 0 0 0 96.012 22.878 A 4.289 4.289 0 0 0 97.06 21.206 A 5.302 5.302 0 0 0 97.2 20.736 Z M 81.043 12.085 A 9.7 9.7 0 0 0 80.622 12.762 A 14.875 14.875 0 0 0 79.509 15.243 Q 79.065 16.518 78.768 18 A 5.02 5.02 0 0 0 81.817 16.685 A 6.907 6.907 0 0 0 82.422 16.074 Q 83.988 14.292 83.988 12.06 A 4.214 4.214 0 0 0 83.971 11.666 Q 83.934 11.276 83.818 11.031 A 0.997 0.997 0 0 0 83.772 10.944 A 0.705 0.705 0 0 0 83.261 10.598 A 1.046 1.046 0 0 0 83.088 10.584 Q 82.072 10.584 81.043 12.085 Z M 113.191 12.085 A 9.7 9.7 0 0 0 112.77 12.762 A 14.875 14.875 0 0 0 111.657 15.243 Q 111.213 16.518 110.916 18 A 5.02 5.02 0 0 0 113.965 16.685 A 6.907 6.907 0 0 0 114.57 16.074 Q 116.136 14.292 116.136 12.06 A 4.214 4.214 0 0 0 116.119 11.666 Q 116.082 11.276 115.966 11.031 A 0.997 0.997 0 0 0 115.92 10.944 A 0.705 0.705 0 0 0 115.409 10.598 A 1.046 1.046 0 0 0 115.236 10.584 Q 114.22 10.584 113.191 12.085 Z M 27.633 6.189 A 2.71 2.71 0 0 0 28.44 4.212 A 3.31 3.31 0 0 0 28.44 4.175 A 2.77 2.77 0 0 0 27.594 2.178 A 3.38 3.38 0 0 0 27.568 2.152 A 2.769 2.769 0 0 0 25.56 1.332 A 3.301 3.301 0 0 0 25.505 1.333 A 2.709 2.709 0 0 0 23.544 2.178 Q 22.716 3.024 22.716 4.212 A 3.388 3.388 0 0 0 22.716 4.249 A 2.739 2.739 0 0 0 23.544 6.228 A 2.855 2.855 0 0 0 24.261 6.756 A 2.805 2.805 0 0 0 25.56 7.056 Q 26.748 7.056 27.594 6.228 A 3.265 3.265 0 0 0 27.633 6.189 Z"
                  />
                </g>
                <circle
                  id="c1"
                  transform="translate(69.00000, 5.80)"
                  r="3.25"
                  cx="3.25"
                  cy="3.25"
                  fill="red"
                />
              </svg>
            </div>
            @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
              @auth
              <a
                href="{{ config('nova.path') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#18B69C] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              >
                Dashboard
              </a>
              @else
              <a
                href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#18B69C] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              >
                Log in
              </a>

              @if (Route::has('register'))
              <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#18B69C] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              >
                Register
              </a>
              @endif @endauth
            </nav>
            @endif
          </header>

          <main class="mt-6">
            <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
              <a
                href="{{ config('nova.path') }}"
                id="docs-card"
                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#18B69C] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#18B69C]"
              >
                <div
                  id="screenshot-container"
                  class="relative flex w-full flex-1 items-stretch"
                >
                  <img
                    src="{{ asset('images/docs-light.svg') }}"
                    alt="App screenshot"
                    class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                    onerror="
                                            document.getElementById('screenshot-container').classList.add('!hidden');
                                            document.getElementById('docs-card').classList.add('!row-span-1');
                                            document.getElementById('docs-card-content').classList.add('!flex-row');
                                            document.getElementById('background').classList.add('!hidden');
                                        "
                  />
                  <img
                    src="{{ asset('images/docs-dark.svg') }}"
                    alt="App screenshot"
                    class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                  />
                  <div
                    class="absolute -bottom-16 -left-16 h-40 w-[calc(100%_+_8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                  ></div>
                </div>

                <div class="relative flex items-center gap-6 lg:items-end">
                  <div
                    id="docs-card-content"
                    class="flex items-start gap-6 lg:flex-col"
                  >
                    <div
                      class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#18B69C]/10 sm:size-16"
                    >
                      <svg
                        class="size-5 sm:size-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                      >
                        <g fill="#18B69C">
                          <path
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                          />
                        </g>
                      </svg>
                    </div>

                    <div class="pt-3 sm:pt-5 lg:pt-0">
                      <h2
                        class="text-xl font-semibold text-black dark:text-white"
                      >
                        Simpede
                      </h2>

                      <p class="mt-4 text-sm/relaxed">
                        Aplikasi Sistem Integrasi Pekerjaan dan Dokumentasi
                        secara Elektronik (Simpede) merupakan perangkat lunak
                        yang dirancang untuk menyederhanakan proses
                        ketatausahaan dengan menyediakan fitur-fitur
                        komprehensif.
                      </p>
                    </div>
                  </div>

                  <svg
                    class="size-6 shrink-0 stroke-[#18B69C]"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                    />
                  </svg>
                </div>
              </a>

              <a
                href="https://docs.simpede.my.id"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#18B69C] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#18B69C]"
              >
                <div
                  class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#18B69C]/10 sm:size-16"
                >
                  <svg
                    class="size-5 sm:size-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <g fill="#18B69C">
                      <path
                        d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z"
                      />
                      <path
                        d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z"
                      />
                    </g>
                  </svg>
                </div>

                <div class="pt-3 sm:pt-5">
                  <h2 class="text-xl font-semibold text-black dark:text-white">
                    Panduan
                  </h2>

                  <p class="mt-4 text-sm/relaxed">
                    Panduan lengkap penggunaan Aplikasi Simpede untuk
                    mempermudah pengguna dalam memahami fitur-fitur dan cara
                    pengoperasian sistem.
                  </p>
                </div>

                <svg
                  class="size-6 shrink-0 self-center stroke-[#18B69C]"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                  />
                </svg>
              </a>

              <a
                href="https://github.com/laravelwebdev/simpede"
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#18B69C] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#18B69C]"
              >
                <div
                  class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#18B69C]/10 sm:size-16"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-6"
                  >
                    <g fill="#18B69C">
                      <path
                        fill="#18B69C"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                      />
                    </g>
                  </svg>
                </div>

                <div class="pt-3 sm:pt-5">
                  <h2 class="text-xl font-semibold text-black dark:text-white">
                    Kolaborasi
                  </h2>

                  <p class="mt-4 text-sm/relaxed">
                    Simpede adalah proyek open source yang mengundang kontribusi
                    dari komunitas pengembang. Bergabunglah dalam pengembangan
                    aplikasi melalui GitHub untuk meningkatkan fitur dan
                    fungsionalitas sistem.
                  </p>
                </div>

                <svg
                  class="size-6 shrink-0 self-center stroke-[#18B69C]"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                  />
                </svg>
              </a>

              <div
                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#18B69C] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#18B69C]"
              >
                <div
                  class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#18B69C]/10 sm:size-16"
                >
                  <svg
                    class="size-5 sm:size-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <g fill="#18B69C">
                      <path
                        d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"
                      />
                    </g>
                  </svg>
                </div>

                <div class="pt-3 sm:pt-5">
                  <h2 class="text-xl font-semibold text-black dark:text-white">
                    Arsitektur
                  </h2>

                  <p class="mt-4 text-sm/relaxed">
                    Simpede dikembangkan menggunakan Framework Laravel versi
                    11+.
                  </p>
                </div>
              </div>
            </div>
          </main>

          <footer
            class="py-16 text-center text-sm text-grey dark:text-grey/70"
          >
            <p>
              Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik
              &middot; v.{{ $version }}
            </p>

            <p>
              Copyright &copy; 2021 -
              <span id="copyright">
                <script>
                  document
                    .getElementById("copyright")
                    .appendChild(
                      document.createTextNode(new Date().getFullYear()),
                    );
                </script>
              </span>
              <a href="{{ config('satker.website') }}" target="_blank">
                {{ $satker }}
              </a>
            </p>
          </footer>
        </div>
      </div>
    </div>
  </body>
</html>
