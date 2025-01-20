export const likeMaterial = (
    slug,
    isLiked,
    isUserAuthenticated,
    likesCount = 0
) => ({
    slug: null,
    isLiked: null,
    likesCount: null,
    isUserAuthenticated: false,

    init() {
        this.slug = slug;

        this.isLiked = isLiked;

        this.likesCount = likesCount;

        this.isUserAuthenticated = isUserAuthenticated;

        this.registerEventListeners();
    },

    toggleLike() {
        if (!this.isUserAuthenticated) {
            this.$dispatch("open-login-required-modal", {
                message: "To like content",
            });

            return;
        }

        if (this.isLiked) {
            this.unlike();
            return;
        }

        this.like();
    },

    like() {
        this.$dispatch("like-material", {
            slug: this.slug,
        });

        this.$wire.like();
    },

    unlike() {
        this.$dispatch("unlike-material", {
            slug: this.slug,
        });

        this.$wire.unlike();
    },

    registerEventListeners() {
        window.addEventListener("like-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isLiked = true;

            this.likesCount++;
        });

        window.addEventListener("unlike-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isLiked = false;

            this.likesCount > 0 ? this.likesCount-- : 0;
        });

        window.addEventListener("dislike-material", (event) => {
            if (event.detail.slug !== this.slug) {
                return;
            }

            this.isLiked = false;

            this.likesCount > 0 ? this.likesCount-- : 0;
        });
    },
});
