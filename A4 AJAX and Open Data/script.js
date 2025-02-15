/******w**************
      
    Assignment 4 Javascript
    Name: Shiqi Yu 
    Date: 09 February 2025
    Description: AJAX Using Open Data

*********************/

// https://data.winnipeg.ca/resource/f9mn-vti8.json

document.addEventListener("DOMContentLoaded", load);

// Set up event listeners
function load() {
    resetForm();

    // listen for form submission
    document.getElementById("search").addEventListener("click", searchDataSet);
    
}

function searchDataSet(e) {
    e.preventDefault();

    let inputDate = document.getElementById('date').value;

    let adjustedDate = inputDate + "T00:00:00.000";

    // Validate input
    if (!inputDate) {
        showMessage(null, null);
        return;
    }

    // Clear previous results
    resetForm();

    // Construct the API URL
    const fullDataSet = "https://data.winnipeg.ca/resource/f9mn-vti8.json"
    const limit = 100;

    // clet commonName = 'Ash'; // This would actually be coming
    // from the form input.
    // const apiUrl = 'https://data.winnipeg.ca/resource/d3jk-
    // hb6j.json?' +
    // `$where=common_name LIKE '%${commonName}%'`
    // +
    // '&$order=diameter_at_breast_height DESC' +
    // '&$limit=100';
    // const encodedURL = encodeURI(apiUrl);
    let customURL= `${fullDataSet}?$where=meeting_date='${adjustedDate}'&$order=meeting_date DESC&$limit=${limit}`;
    console.log("Custom URL:", customURL);  // Log the custom URL to debug

    let encodedURL = encodeURI(customURL);

    // Fetch Data
    fetch(encodedURL)
        // handle errors
        .then(function(result) {
            return result.json();
        })
            .then(function(data) {
                console.log("API Data:", data)
                // Compare based on date only (ignore time)
                let filteredData = data.filter(d => {
                    console.log("Raw meeting_date:", d.meeting_date); // Log the raw meeting_date value
                    let meetingDate = new Date(d.meeting_date);
                    meetingDate.setHours(0,0,0,0);

                    // Normalize both dates to YYYY-MM-DD format
                    let meetingDateStr = meetingDate.toISOString().split('T')[0]; // Format: YYYY-MM-DD
                    
                    // Check if the dates match
                    return meetingDateStr  === inputDate;
                });

                if (filteredData.length == 0){
                    showMessage(filteredData.length, inputDate);
                } else {
                    populateTable(filteredData);
                    showMessage(filteredData.length, inputDate);
                }
            })
            .catch(error => console.error("Error fetching data", error));
}

function populateTable(data) {
    let table = document.getElementById('results');
    table.innerHTML = '';

    // Append rows
    for (let datum of data) {
        addRow(datum, table)
    }

    // Make table visible after pupulation
    document.querySelector('table').style.display = 'table';
    document.querySelector('thead').style.display = 'table-header-group';
}

function addRow(datum, table){
    // Extract just the date portion (MM/DD/YYYY) from the meeting_date
    let meetingDate = new Date(datum.meeting_date);
    let formattedDate = meetingDate.toISOString().split('T')[0];

    // Create a new row for each record
    let row = `<tr>
        <td>${datum.meeting_id}</td>
        <td>${formattedDate}</td>
        <td><a href="${datum.agenda_link}" target = "_blank">Agenda</a></td>
        <td>${datum.title}</td>
        <td>${datum.vote}</td>
    </tr>`;

    // Append to table
    table.innerHTML += row;
}

function showMessage(count, inputDate) {
    let message = document.getElementById("message");

    if(count === null) {
        message.innerHTML = "Please enter a valid date.";
    } else if (count > 0) {
        message.innerHTML = `Found ${count} results for the date ${inputDate}.`;
    } else {
        message.innerHTML = `No results found for the date ${inputDate}.`;
    }
}

function resetForm() {
    // Clear the input field
    document.getElementById('date').value = "";

    // Clear the table body (rows)
    document.querySelector('tbody').innerHTML= "";

    // Hide the table initially (before population)
    document.querySelector('table').style.display = "none";

    // Hide the table header twoo
    document.querySelector('thead').style.display = "none";
}







