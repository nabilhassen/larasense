import "./bootstrap";
import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import "@fontsource/inter";
import "plyr/dist/plyr.css";
import { podcastPlayer } from "./podcast-player";
import { mainPodcastPlayer } from "./main-podcast-player";

Alpine.data("mainPodcastPlayer", mainPodcastPlayer);

Alpine.data("podcastPlayer", podcastPlayer);

Livewire.start();
