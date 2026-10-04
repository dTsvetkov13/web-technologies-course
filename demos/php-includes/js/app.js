// app.js - Client-side JavaScript for AJAX communication

// DOM Elements
const ajaxForm = document.getElementById('ajaxForm');
const usernameInput = document.getElementById('username');
const colorSelect = document.getElementById('color');
const sendBtn = document.getElementById('sendBtn');
const responseSection = document.getElementById('responseSection');
const responseBox = document.getElementById('response');

// Event Listener - Handle form submission
ajaxForm.addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission
    handleSendRequest();
});

/**
 * Handles the send request button click
 */
function handleSendRequest() {
    const username = usernameInput.value.trim();
    const color = colorSelect.value;
    
    // Basic validation
    if (!username) {
        alert('Моля, въведи име!');
        usernameInput.focus();
        return;
    }
    
    if (!color) {
        alert('Моля, избери цвят!');
        colorSelect.focus();
        return;
    }
    
    // Send AJAX request
    sendAjaxRequest(username, color);
}

/**
 * Sends AJAX request to the server
 * @param {string} username - User's name
 * @param {string} color - Selected color
 */
function sendAjaxRequest(username, color) {
    // Disable button and show loading state
    sendBtn.disabled = true;
    sendBtn.textContent = 'Изпраща се...';
    responseBox.innerHTML = '<p class="placeholder">Зарежда се...</p>';
    
    // Prepare data
    const data = {
        username: username,
        color: color
    };
    
    // Log what we're sending
    console.log('📤 Sending to server:', data);
    
    // Create XMLHttpRequest
    const xhr = new XMLHttpRequest();
    
    // Configure request
    xhr.open('POST', 'api/process.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    
    // Log request details
    console.group('📋 Request Details');
    console.log('Method:', 'POST');
    console.log('URL:', 'api/process.php');
    console.log('Headers:', {
        'Content-Type': 'application/json'
    });
    console.log('Body:', JSON.stringify(data));
    console.groupEnd();
    
    // Handle response
    xhr.onload = function() {
        // Log response details
        console.group('📥 Response Details');
        console.log('Status:', xhr.status, xhr.statusText);
        console.log('Headers:', xhr.getAllResponseHeaders());
        console.log('Raw Response:', xhr.responseText);
        console.groupEnd();
        
        // Re-enable button
        sendBtn.disabled = false;
        sendBtn.textContent = 'Изпрати към сървъра';
        
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                
                // Log parsed JSON
                console.log('✅ Received from server:', response);
                
                displayResponse(response);
            } catch (e) {
                displayError('Грешка при парсиране на отговора');
                console.error('❌ Parse error:', e);
            }
        } else {
            displayError('Грешка при свързване със сървъра');
            console.error('❌ Server error:', xhr.status, xhr.responseText);
        }
    };
    
    // Handle network errors
    xhr.onerror = function() {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Изпрати към сървъра';
        displayError('Мрежова грешка');
        console.error('❌ Network error - unable to reach server');
    };
    
    // Send request
    xhr.send(JSON.stringify(data));
}

/**
 * Displays the server response in the UI
 * @param {Object} response - Response object from server
 */
function displayResponse(response) {
    if (response.success) {
        responseBox.classList.add('has-data');
        responseBox.innerHTML = `
            <div class="response-content">
                <h3>✅ Успешно!</h3>
                <p><strong>Поздрав:</strong> ${escapeHtml(response.data.greeting)}</p>
                <p><strong>Твоят цвят:</strong> ${escapeHtml(response.data.colorName)}
                    <span class="color-preview" style="background-color: ${escapeHtml(response.data.color)};"></span>
                </p>
                <p><strong>Дължина на името:</strong> ${response.data.nameLength} символа</p>
                <p><strong>Време на заявката:</strong> ${escapeHtml(response.data.timestamp)}</p>
                <p><strong>IP адрес:</strong> ${escapeHtml(response.data.clientIp)}</p>
            </div>
        `;
        
        // Smooth scroll to response
        responseSection.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        displayError(response.message || 'Неизвестна грешка');
    }
}

/**
 * Displays error message in the UI
 * @param {string} message - Error message
 */
function displayError(message) {
    responseBox.classList.remove('has-data');
    responseBox.innerHTML = `
        <div class="response-content">
            <h3 style="color: #dc3545;">❌ Грешка</h3>
            <p>${escapeHtml(message)}</p>
        </div>
    `;
}

/**
 * Escapes HTML to prevent XSS attacks
 * @param {string} text - Text to escape
 * @returns {string} - Escaped text
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Alternative modern approach using Fetch API (commented out)
/*
async function sendFetchRequest(username, color) {
    sendBtn.disabled = true;
    sendBtn.textContent = 'Изпраща се...';
    
    try {
        const response = await fetch('api/process.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ username, color })
        });
        
        const data = await response.json();
        displayResponse(data);
    } catch (error) {
        displayError('Грешка при свързване със сървъра');
        console.error('Fetch error:', error);
    } finally {
        sendBtn.disabled = false;
        sendBtn.textContent = 'Изпрати към сървъра';
    }
}
*/
