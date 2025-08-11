<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
<style>
    /* General Body and Font Styles */
    body {
        font-family: "Inter", sans-serif;
        background-color: #f3f4f6;
        margin: 0;
    }

    /* Main container for centering the form */
    .main-container {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem; /* Added horizontal padding for mobile */
        min-height: 100vh;
        box-sizing: border-box;
    }

    /* Form wrapper/card */
    .form-wrapper {
        width: 100%;
        max-width: 42rem; /* max-w-2xl */
        border-radius: 0.5rem; /* rounded-lg */
        background-color: white;
        padding: 2.5rem; /* p-10 */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
            0 4px 6px -4px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }

    /* Top image styling */
    .form-image {
        margin-bottom: 1rem;
        width: 100%;
        border-radius: 0.5rem;
        height: auto;
    }

    /* Header section for title and description */
    .form-header {
        margin-bottom: 2rem; /* mb-8 */
        text-align: center;
    }

    .form-title {
        font-size: 1.875rem; /* text-2xl */
        font-weight: 600; /* font-semibold */
        color: #1f2937; /* text-gray-800 */
    }

    .form-description {
        background-color: #f0c8c8ff; /* bg-red-50 */
        padding: 10px;
        background-clip: padding-box;
        border: dotted darkred;
        font-size: 15px;
    }

        .form-tips {
        background-color: #8df4a3ff; /* bg-red-50 */
        padding: 10px;
        background-clip: padding-box;
        border: dotted darkgreen;
        font-size: 15px;
    }
    /* Error message styling */
    .form-error {
        color: #dc2626; /* text-red-600 */
        font-size: 0.75rem; /* text-sm */
        margin-top: -1rem; /* mt-2 */
        text-align: left;
    }

    /* Container for each form field group */
    .form-group {
        margin-bottom: 1.5rem; /* mb-6 */
    }

    /* Form labels */
    .form-label {
        display: block;
        margin-bottom: 0.5rem; /* mb-2 */
        font-size: 0.875rem; /* text-sm */
        font-weight: 500; /* font-medium */
        color: #4b5563; /* text-gray-600 */
    }

    /* Common styles for input, select, and textarea */
    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 0.375rem; /* rounded-md */
        border: 1px solid #d1d5db; /* border-gray-300 */
        padding: 0.75rem; /* p-3 */
        font-size: 0.875rem; /* text-sm */
        color: #1f2937; /* text-gray-800 */
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #0bb430ff; /* focus:border-indigo-500 */
        box-shadow: 0 0 0 1px #0bb430ff; /* focus:ring-1 focus:ring-indigo-500 */
        outline: none;
    }

    /* Radio button group */
    .radio-group {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .radio-item {
        display: flex;
        align-items: center;
    }

    .form-radio {
        height: 1rem;
        width: 1rem;
        color: #0bb430ff; /* text-indigo-600 */
    }

    .radio-label {
        margin-left: 0.5rem; /* ml-2 */
        font-size: 0.875rem;
        color: #4b5563;
    }

    /* Checkbox group */
    .checkbox-group {
        display: flex;
        align-items: center;
    }

    .form-checkbox {
        height: 1rem; /* h-4 */
        width: 1rem; /* w-4 */
        color: #0bb430ff; /* text-indigo-600 */
    }

    .checkbox-label {
        margin-left: 0.5rem; /* ml-2 */
        font-size: 0.875rem; /* text-sm */
        color: #4b5563; /* text-gray-600 */
    }

    /* Submit Button */
    .submit-btn {
        width: 100%;
        border-radius: 0.375rem; /* rounded-md */
        background-color: #0bb430ff; /* bg-indigo-600 */
        padding: 0.75rem 1.5rem; /* px-6 py-3 */
        font-weight: 500; /* font-medium */
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .submit-btn:hover {
        background-color: rgba(8, 136, 36, 0.5); /* hover:bg-indigo-700 */
    }

    .submit-btn:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(8, 136, 36, 0.5); /* focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 */
    }
        .footer {
            position: sticky;
            left: 0;
            bottom: 0;
            width: 100%;
            background: #f3f4f6;
            text-align: center;
            font-size: 0.85rem;
            padding: 0.5rem 0;
            color: #4b5563;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.04);
            z-index: 100;
        }
        .footer-link {
            color: #0bb430ff;
            text-decoration: none;
            font-weight: 500;
        }
        .footer-link:hover {
            text-decoration: underline;
            color: #087824;
        }

    /* Mobile Responsive Styles */
    @media (max-width: 640px) {
        .main-container {
            padding: 1rem;
        }
        .form-wrapper {
            padding: 1.5rem;
        }
        .form-title {
            font-size: 1.5rem;
        }
        .footer {
            font-size: 0.75rem;
            padding: 0.4rem 0;
        }
    }
</style>
    <title>Penggantian Pulsa</title>
  </head>
  <body>    
<div class="main-container">

    <div class="form-wrapper">
      @yield('form')
    </div>
</div>
    <footer class="footer">
        <div>
            <div>
                Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik &middot; v.{{ $version }}
            </div>
            <div>
                Copyright &copy; 2021 -
                <span id="copyright">
                    <script>
                        document.getElementById("copyright").appendChild(document.createTextNode(new Date().getFullYear()));
                    </script>
                </span>
                <a href="{{ config('satker.website') }}" target="_blank" class="footer-link">
                    {{ $satker }}
                </a>
            </div>
        </div>
    </footer>
@include('sweetalert2::index')
  </body>
</html>