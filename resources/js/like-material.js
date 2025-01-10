export const likeMaterial = (slug, isLiked, likesCount = 0) => ({
    slug: null,
    isLiked: null,
    likesCount: null,

    init() {
        this.slug = slug;

        this.isLiked = isLiked;

        this.likesCount = likesCount;

        this.registerEventListeners();
    },

    toggleLike() {
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
