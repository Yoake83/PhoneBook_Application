console.log("Phonebook.js is loaded!");

function loadContacts() {
    
    fetch('Phone.php', {
        method: 'GET'
    })
    .then(response => response.json()) 
    .then(data => {
        let output = "<h2>Contact List</h2><ul>";
        data.forEach(contact => {
            output += `<li>${contact.name} - ${contact.phone} - ${contact.email}</li>`;
        });
        output += "</ul>";
        document.getElementById("contact-list").innerHTML = output;
    })
    .catch(error => console.error("Error loading contacts:", error));
}

function addContact() {
    let name = document.getElementById("name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let email = document.getElementById("email").value.trim();

    
    if (!name || !phone || !email) {
        alert("All fields are required!");
        return;
    }

    
    fetch('Phone.php', {
        method: 'POST',
        body: new URLSearchParams({
            name: name,
            phone: phone,
            email: email
        })
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadContacts(); 
    })
    .catch(error => console.error("Error adding contact:", error));
}

