export const dislikeMaterial = (slug, isDisliked) => ({
    slug: null,
    isDisliked: null,

    init() {
        this.slug = slug;

        this.isDisliked = isDisliked;

        this.registerEventListeners();
    },

    toggleDislike() {
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
