export const likeMaterial = (slug, isLiked, likesCount) => ({
    slug: null,
    isLiked: null,
    likesCount: null,

    async init() {
        this.slug = slug;

        this.isLiked = isLiked;

        this.likesCount = likesCount;
    },

    like() {
        if (this.isLiked) {
            this.unlike(this.slug);
            return;
        }

        this.isLiked = true;

        this.likesCount++;

        this.$dispatch("like-material", {
            slug: this.slug,
        });

        this.$wire.like();
    },

    unlike(slug) {
        if (!this.isLiked || slug !== this.slug) {
            return;
        }

        this.isLiked = false;

        this.likesCount--;

        this.$wire.unlike();
    },
});
