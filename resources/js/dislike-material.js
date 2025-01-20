export const dislikeMaterial = (slug, isDisliked, isUserAuthenticated) => ({
    slug: null,
    isDisliked: null,
    isUserAuthenticated: false,

    init() {
        this.slug = slug;

        this.isDisliked = isDisliked;

        this.isUserAuthenticated = isUserAuthenticated;

        this.registerEventListeners();
    },

    toggleDislike() {
        if (!this.isUserAuthenticated) {
            this.$dispatch("open-login-required-modal", {
                message: "To dislike content",
            });

            return;
        }

        if (this.isDisliked) {
            this.undislike();
            return;
        }

        this.dislike();
    },

    dislike() {
        this.$dispatch("dislike-material", {
            slug: this.slug,
        });

        this.$wire.dislike();
    },

    undislike() {
        this.$dispatch("undislike-material", {
            slug: this.slug,
        });

        this.$wire.undislike();
    },

    registerEventListeners() {
        window.addEventListener("dislike-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isDisliked = true;
        });

        window.addEventListener("undislike-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isDisliked = false;
        });

        window.addEventListener("like-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isDisliked = false;
        });
    },
});
