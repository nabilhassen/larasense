import Plyr from "plyr";
import plyrSvg from "plyr/dist/plyr.svg";

export const youtubePlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el, {
            loadSprite: false,
            iconUrl: plyrSvg,
        });

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },
});
