import Plyr from "plyr";
import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";

export const mainPodcastPlayer = () => ({
    player: {},
    thumbnail: "",
    isSourceSet: false,
    url: "",

    init() {
        this.player = new Plyr("#main-podcast-player");

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

    setSource(title, url, thumbnail, currentTime) {
        this.thumbnail = thumbnail;
        this.url = url;

        this.player.source = {
            type: "audio",
            title: title,
            sources: [
                {
                    src: this.url,
                    type: "audio/mp3",
                },
            ],
        };

        this.setCurrentTime(currentTime);

        this.isSourceSet = true;
    },

    play({ title, url, thumbnail, currentTime = 0 }) {
        if (this.isSourceSet && this.url === url) {
            this.player.play();
            return this.player;
        }

        this.setSource(title, url, thumbnail, currentTime);

        this.player.play();

        Alpine.store("mainPodcastPlayer").url = this.url;

        return this.player;
    },
});
