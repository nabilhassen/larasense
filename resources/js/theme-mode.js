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
        this.mode === "light" ? (this.mode = "dark") : (this.mode = "light");

        localStorage.setItem("themeMode", this.mode);
        document.documentElement.classList.toggle("dark", this.isDark());
        document
            .querySelector('meta[name="theme-color"]')
            .setAttribute("content", this.isDark() ? "black" : "#EF5A6F");
    },

    isDark() {
        return this.mode === "dark";
    },
};
