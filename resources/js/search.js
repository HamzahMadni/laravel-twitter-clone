import { debounce } from "lodash";

// Explore Search
const searchInput = document.getElementById("username");

if (searchInput) {
    const url = new URL(location);
    searchInput.value = url.searchParams.get("username");

    const search = () => {
        const url = new URL(location);
        url.searchParams.set("username", searchInput.value);
        location = url.href;
    };

    searchInput?.addEventListener("input", debounce(search, 400));
}
