import Plyr from "plyr";

export const podcastPlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el.querySelector(".player"));

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
