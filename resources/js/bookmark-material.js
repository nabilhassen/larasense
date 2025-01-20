export const bookmarkMaterial = (slug, isBookmarked, isUserAuthenticated) => ({
    slug: null,
    isBookmarked: null,
    isUserAuthenticated: false,

    init() {
        this.slug = slug;

        this.isBookmarked = isBookmarked;

        this.isUserAuthenticated = isUserAuthenticated;

        this.registerEventListeners();
    },

    toggleBookmark() {
        if (!this.isUserAuthenticated) {
            this.$dispatch("open-login-required-modal", {
                message: "To bookmark content",
            });

            return;
        }

        if (this.isBookmarked) {
            this.unbookmark();
            return;
        }

        this.bookmark();
    },

    bookmark() {
        this.$dispatch("bookmark-material", {
            slug: this.slug,
        });

        this.$wire.bookmark();
    },

    unbookmark() {
        this.$dispatch("unbookmark-material", {
            slug: this.slug,
        });

        this.$wire.unbookmark();
    },

    registerEventListeners() {
        window.addEventListener("bookmark-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isBookmarked = true;
        });

        window.addEventListener("unbookmark-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isBookmarked = false;
        });
    },
});
