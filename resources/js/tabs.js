// Profile Tabs
const tabContainer = document.getElementById("tabContainer");

const postsTab = document.getElementById("posts");
const followersTab = document.getElementById("followers");
const followingTab = document.getElementById("following");

const postsContainer = document.getElementById("postsContainer");
const followersContainer = document.getElementById("followersContainer");
const followingContainer = document.getElementById("followingContainer");

const handleTabClicked = (currentContainer) => {
    // only do if not already visible
    if (currentContainer.classList.contains("hidden")) {
        // hide currently visible container
        [postsContainer, followersContainer, followingContainer].forEach(
            (container) => {
                if (!container.classList.contains("hidden")) {
                    container.classList.toggle("hidden");
                }
            }
        );

        // make folllowers container visible
        currentContainer.classList.toggle("hidden");
    }
};

tabContainer?.addEventListener("click", (event) => {
    console.log("test");
    switch (event.target) {
        case postsTab:
            handleTabClicked(postsContainer);
            break;
        case followersTab:
            handleTabClicked(followersContainer);
            break;
        case followingTab:
            handleTabClicked(followingContainer);
            break;
        default:
            break;
    }
});
