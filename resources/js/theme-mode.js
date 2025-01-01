export const themeMode = {
    mode: null,

    init() {
        let systemThemeMode = window.matchMedia("(prefers-color-scheme: dark)")
            .matches
            ? "dark"
            : "light";

        this.mode = localStorage.themeMode ?? systemThemeMode;
    },

    toggle() {
        if (this.mode === "light") {
            localStorage.themeMode = "dark";
            this.mode = localStorage.themeMode;
            return;
        }

        localStorage.themeMode = "light";
        this.mode = localStorage.themeMode;
    },

    isDark() {
        return this.mode === "dark";
    },
};
