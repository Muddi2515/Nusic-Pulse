<?php
require_once "connection.php";
include("header.php");
?>
<script>
    $(document).ready(function() {
        // Function to search artists 
        function searchArtists(inputElement) {
            var searchValue = inputElement ? inputElement.value : ''; // Check if inputElement is provided

            // Make AJAX request
            $.ajax({
                url: 'search_albums.php?searchByAlbum=true&searchFromAllMusic=false&searchFromAllVideo=false',
                type: 'GET',
                data: {
                    search: searchValue
                },
                success: function(response) {
                    // Reset the previous data in the table                    
                    $('#albums_section').empty();

                    // Append new data (assuming `response` contains valid HTML rows)
                    $('#albums_section').append(response);

                    // Highlight the matched text if the search value is not empty
                    if (searchValue !== '') {
                        highlightSearchTerm(searchValue);
                    }
                }
            });
        }

        function highlightSearchTerm(term) {
            // Ensure we are only searching within the artist divs
            $('.artist').each(function() {
                var artistDiv = $(this); // Current artist div

                // Find text elements that should be highlighted, such as name and about fields
                artistDiv.find('h2, p').each(function() {
                    var element = $(this); // Current h2 or p tag

                    var elementText = element.text(); // Get plain text

                    // Create a regex for case-insensitive matching
                    var regex = new RegExp('(' + term + ')', 'gi');

                    // Replace the matching text with a span wrapped around it
                    var newHtml = elementText.replace(regex, '<span class="highlight">$1</span>');

                    element.html(newHtml); // Update the element content with highlighted text
                });
            });
        }

        $(document).ready(function() {
            // Call the searchArtists function on page load
            searchArtists(); // This will call the function without any inputElement, using an empty string

            // Event listener for input
            $('#search').on('input', function() {

                // Get the current value of the search input
                searchArtists(this); // Pass the input element to the function
            });
        });

    });
</script>

<div class="music_area music_gallery" style="background-color: #1D1F21;">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <form method="get">
                    <div class="form-outline" data-mdb-input-init>
                        <input type="search" id="search" name="search" class="form-control" placeholder="Search Album" style="border-radius: 50px; width:200px; float:left;" />
                    </div>
                    <!-- <input style="border-radius: 50px;" type="submit" value="Search" name="search_btn" class="btn ml-1 btn-primary" data-mdb-ripple-init> -->
                </form>
            </div>
            <div class="col-xl-6">
                <div class="section_title text-left mb-65">
                    <h3 class="text-warning">Albums</h3>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center mb-20" id="albums_section">
            
        </div>
    </div>
</div>

<!-- contact_rsvp -->
<div class="contact_rsvp">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="text text-center">
                    <h3>Contact For RSVP</h3>
                    <a class="boxed-btn3" href="contact.php">Contact Me</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ contact_rsvp -->

<?php
include("footer.php")
?>