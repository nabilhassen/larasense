import "./bootstrap";
import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";
import "@fontsource/inter";
import Plyr from "plyr";
import "plyr/dist/plyr.css";

const players = Plyr.setup(".player");

Livewire.start();
