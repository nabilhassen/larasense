export const dislikeMaterial = (slug, isDisliked) => ({
    slug: null,
    isDisliked: null,

    async init() {
        this.slug = slug;

        this.isDisliked = isDisliked;
    },

    toggleDislike() {
        if (this.isDisliked) {
            this.undislike(this.slug);
            return;
        }

        this.dislike();
    },

    dislike() {
        this.isDisliked = true;

        this.$dispatch("dislike-material", {
            slug: this.slug,
        });

        this.$wire.dislike();
    },

    undislike(slug) {
        if (!this.isDisliked || slug !== this.slug) {
            return;
        }

        this.isDisliked = false;

        this.$wire.undislike();
    },
});
