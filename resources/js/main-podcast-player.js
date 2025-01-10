import Plyr from "plyr";
import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";
import plyrSvg from "plyr/dist/plyr.svg";

export const mainPodcastPlayer = () => ({
    player: {},
    isSourceSet: false,
    url: "",
    material: {},
    publishedAt: "",
    duration: "",

    init() {
        this.player = new Plyr("#main-podcast-player", {
            loadSprite: false,
            iconUrl: plyrSvg,
        });

        Alpine.store("mainPodcastPlayer", {
            isPlaying: this.player.playing,
            url: this.url,
        });

        this.player.on(
            "pause",
            () => (Alpine.store("mainPodcastPlayer").isPlaying = false)
        );

        this.player.on(
            "play",
            () => (Alpine.store("mainPodcastPlayer").isPlaying = true)
        );
    },

    setCurrentTime(time) {
        if (time <= 0) {
            return this.player;
        }

        this.player.on("loadeddata", () => (this.player.currentTime = time));

        return this.player;
    },

    setSource(material, publishedAt, duration, currentTime) {
        this.material = material;
        this.publishedAt = publishedAt;
        this.duration = duration;
        this.url = material.url;

        this.player.source = {
            type: "audio",
            title: material.title,
            sources: [
                {
                    src: material.url,
                },
            ],
        };

        this.setCurrentTime(currentTime);

        this.isSourceSet = true;
    },

    play({ material, publishedAt, duration, currentTime = 0 }) {
        if (this.isSourceSet && this.url === material.url) {
            this.player.play();
            return this.player;
        }

        this.player?.destroy();

        this.init();

        this.setSource(material, publishedAt, duration, currentTime);

        this.player.play();

        Alpine.store("mainPodcastPlayer").url = this.url;

        return this.player;
    },
});
