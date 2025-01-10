import Plyr from "plyr";

export const podcastPlayer = () => ({
    player: {},

    init() {
        this.player = new Plyr(this.$el.querySelector(".player"), {
            loadSprite: false,
            iconUrl: "vendor/plyr/plyr.svg",
        });

        this.player.on("play", () => this.$dispatch("pause-podcast"));
    },

    continueOnMainPodcastPlayer({ material, publishedAt, duration }) {
        if (!this.player.playing || this.player.ended) {
            return;
        }

        this.player.pause();

        this.$dispatch("play-podcast", {
            material: material,
            publishedAt: publishedAt,
            duration: duration,
            currentTime: this.player.currentTime,
        });
    },
});
