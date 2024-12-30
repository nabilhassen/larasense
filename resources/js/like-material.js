export const likeMaterial = (slug, isLiked) => ({
    slug: null,
    isLiked: null,

    async init() {
        this.slug = slug;

        this.isLiked = isLiked;
    },

    like() {
        if (this.isLiked) {
            this.unlike(this.slug);
            return;
        }

        this.isLiked = true;

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

        this.$wire.unlike();
    },
});
