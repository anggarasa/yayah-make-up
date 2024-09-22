import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
        "node_modules/preline/dist/*.js",
    ],

    theme: {
        backgroundImage: {
            "ungu-linear-bawah": "linear-gradient(to bottom, #7A1CAC, #320B46)",
            "ungu-linear-kanan":
                "linear-gradient(to bottom right, #7A1CAC, #000000)",
        },
        colors: {
            "ungu-white": "#AD49E1",
            "ungu-dark": "#7A1CAC",
        },
        extend: {
            width: {
                74: "296",
            },
            height: {
                200: "485px",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
                body: [
                    "Inter",
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "system-ui",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "Noto Sans",
                    "sans-serif",
                    "Apple Color Emoji",
                    "Segoe UI Emoji",
                    "Segoe UI Symbol",
                    "Noto Color Emoji",
                ],
            },
        },
    },

    plugins: [forms, require("preline/plugin"), require("flowbite/plugin")],
};
