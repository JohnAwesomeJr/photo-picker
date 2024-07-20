# Photography Customer Selection Interface

Welcome to the Photography Customer Selection Interface repository! This simple web application allows photographers to create personalized galleries for their clients. Clients can easily browse photos, select their favorites, receive a price quote based on the number of photos chosen, and send their selections directly to the photographer via email.

## Key Features

- **Client-Friendly Interface:** Clients can conveniently view and choose their desired photos from a personalized gallery.
    
- **Effortless Setup:** Setting up a new client gallery is straightforward:
    
    - Duplicate the `example-gallery` directory and rename it to create a unique client directory.
    - Populate the `photos` within the new directory with photos for the client to select from.
- **Automatic Price Quotes:** Based on the number of photos selected, clients receive an automatic price quote before finalizing their choices.
    
- **Email Notifications:** When clients finalize their selections, the photographer receives an email listing the chosen photos and the agreed-upon price, streamlining the fulfillment process.
    

## How It Works

1.  **Setup Instructions:**
    
    - Upload the repository to any web server that supports PHP.
    - To add a new client:
        - Duplicate the `example-gallery` directory and rename it (e.g., `client1`).
        - Place the photos you want the client to choose from into the `photo_folder` within the new directory.
2.  **Client Experience:**
    
    - Clients access their unique URL (e.g., `http://yourdomain.com/client1/`).
    - They can browse through photos, mark their favorites, and view a price quote based on their selections.
    - After confirming, the client clicks 'Buy' to finalize their selections, and the photographer receives an email with the list of chosen photos and the agreed-upon price.
3.  **Managing Client Galleries:**
    
    - To remove a client gallery after completing your work together, simply delete their directory. This keeps your workspace tidy and organized.

## Why Use This Interface?

- **Simplicity:** This application focuses on one task—allowing clients to select photos—making it intuitive for both clients and photographers.
    
- **Flexibility:** You can easily create and manage multiple client galleries by duplicating the `example` directory and customizing it for each client.
    
- **Enhanced Communication:** By automating the selection, pricing, and notification process, you can provide a seamless experience for your clients while saving time on administrative tasks.
    

## Requirements

- PHP-enabled web server.
- Basic knowledge of uploading files to a web server.