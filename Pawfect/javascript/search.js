
document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById("searchInput");
    var searchResultsContainer = document.getElementById("searchResults");

    searchInput.addEventListener("input", function() {
        var searchQuery = searchInput.value;
        fetchSearchResults(searchQuery);
    });

    function fetchSearchResults(query) {
        // Make an AJAX request to the server using Fetch API
        fetch("search.php?query=" + encodeURIComponent(query))
            .then(response => response.text())
            .then(data => {
                // Update the search results container with the response from the server
                searchResultsContainer.innerHTML = data;
            })
            .catch(error => console.error('Error fetching data:', error));
    }
});
