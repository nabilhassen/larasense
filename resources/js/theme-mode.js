export const themeMode = {
    mode: null,

    init() {
        let systemThemeMode = window.matchMedia("(prefers-color-scheme: dark)")
            .matches
            ? "dark"
            : "light";

        this.mode = localStorage.getItem("themeMode") ?? systemThemeMode;
    },

    toggle() {
        if (this.mode === "light") {
            localStorage.setItem("themeMode", "dark");
            this.mode = localStorage.getItem("themeMode");
            return;
        }

        localStorage.setItem("themeMode", "light");
        this.mode = localStorage.getItem("themeMode");
    },

    isDark() {
        return this.mode === "dark";
    },
};
