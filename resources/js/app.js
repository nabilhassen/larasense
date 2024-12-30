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

Alpine.data("mainPodcastPlayer", mainPodcastPlayer);

Alpine.data("podcastPlayer", podcastPlayer);

Alpine.data("youtubePlayer", youtubePlayer);

Alpine.data("likeMaterial", likeMaterial);

Alpine.data("dislikeMaterial", dislikeMaterial);

Livewire.start();
