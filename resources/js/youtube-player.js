import Plyr from "plyr";

export const youtubePlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el);

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },
});
