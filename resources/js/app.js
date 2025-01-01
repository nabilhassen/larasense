import "./bootstrap";
import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import "@fontsource/inter";
import "plyr/dist/plyr.css";
import { podcastPlayer } from "./podcast-player";
import { mainPodcastPlayer } from "./main-podcast-player";
import { youtubePlayer } from "./youtube-player";
import { likeMaterial } from "./like-material";
import { dislikeMaterial } from "./dislike-material";
import { bookmarkMaterial } from "./bookmark-material";
import { copyLink } from "./copy-link";
import { themeMode } from "./theme-mode";

window.Alpine = Alpine;

Alpine.data("mainPodcastPlayer", mainPodcastPlayer);

Alpine.data("podcastPlayer", podcastPlayer);

Alpine.data("youtubePlayer", youtubePlayer);

Alpine.data("likeMaterial", likeMaterial);

Alpine.data("dislikeMaterial", dislikeMaterial);

Alpine.data("bookmarkMaterial", bookmarkMaterial);

Alpine.data("copyLink", copyLink);

Alpine.store("themeMode", themeMode);

Livewire.start();
