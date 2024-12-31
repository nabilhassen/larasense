import Plyr from "plyr";

export const youtubePlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el, {
            keyboard: {
                focused: true,
                global: true,
            },
        });

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },
});
