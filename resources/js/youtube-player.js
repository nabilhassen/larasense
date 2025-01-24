import Plyr from "plyr";

export const youtubePlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el, {
            loadSprite: false,
            iconUrl: `${location.origin}/vendor/plyr/plyr.svg`,
        });

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },
});
