import Plyr from "plyr";
import plyrSvg from "plyr/dist/plyr.svg";

export const podcastPlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el.querySelector(".player"), {
            loadSprite: false,
            iconUrl: plyrSvg,
        });

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },

    continueOnMainPodcastPlayer({ material }) {
        if (!this.player.playing || this.player.ended) {
            return;
        }

        this.player.pause();

        this.$dispatch("play-podcast", {
            title: material.title,
            url: material.url,
            thumbnail: material.thumbnail,
            currentTime: this.player.currentTime,
        });
    },
});
