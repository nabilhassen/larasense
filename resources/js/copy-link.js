export const copyLink = (link) => ({
    isCopied: false,
    link: null,

    init() {
        this.link = link;
    },

    copy() {
        navigator.clipboard.writeText(this.link);

        this.isCopied = true;

        setTimeout(() => (this.isCopied = false), 2000);
    },
});
