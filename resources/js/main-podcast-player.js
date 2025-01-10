import Plyr from "plyr";
import { Alpine } from "../../vendor/livewire/livewire/dist/livewire.esm";

export const mainPodcastPlayer = () => ({
    player: {},
    isSourceSet: false,
    url: "",
    thumbnail: "",
    publisherName: "",
    materialTitle: "",
    publishedAt: "",
    duration: "",

    init() {
        this.initMainPodcastPlayerStore();
    },

    setup({
        url,
        thumbnail,
        publisherName,
        materialTitle,
        publishedAt,
        duration,
        currentTime = 0,
    }) {
        if (this.isSourceSet && this.url === url) {
            this.player.play();
            return;
        }

        this.initPlyr();

        this.registerEventListeners();

        this.setSource(
            url,
            thumbnail,
            publisherName,
            materialTitle,
            publishedAt,
            duration,
            currentTime
        );

        this.play();
    },

    initPlyr() {
        this.isSourceSet && this.player.destroy();

        this.player = new Plyr("#main-podcast-player", {
            loadSprite: false,
            iconUrl: "vendor/plyr/plyr.svg",
        });
    },

    initMainPodcastPlayerStore() {
        Alpine.store("mainPodcastPlayer", {
            isPlaying: this.player.playing,
            url: this.url,
        });
    },

    registerEventListeners() {
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

    setSource(
        url,
        thumbnail,
        publisherName,
        materialTitle,
        publishedAt,
        duration,
        currentTime
    ) {
        this.url = url;
        this.thumbnail = thumbnail;
        this.publisherName = publisherName;
        this.materialTitle = materialTitle;
        this.publishedAt = publishedAt;
        this.duration = duration;

        this.player.source = {
            type: "audio",
            sources: [
                {
                    src: this.url,
                },
            ],
        };

        this.setCurrentTime(currentTime);

        this.isSourceSet = true;
    },

    play() {
        this.player.play();
        Alpine.store("mainPodcastPlayer").url = this.url;
    },
});
