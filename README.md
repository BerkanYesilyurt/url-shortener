<p align="center"> 
<img src="https://user-images.githubusercontent.com/8729215/179297577-2a25b2e6-c3c7-4a4a-b43b-9a5c77b19190.png">
</p>

# URL Shortener
The modern, privacy-aware URL Shortener built in Laravel & PHP.

## Default Admin Account
- E-mail: admin@admin.com
- Password: admin123

## Features
- URL shortener transforming long, ugly links into nice, memorable and trackable short URLs.
- All links can be shortened with or without membership.
- Public & Private links (private: only the desired emails can access the real URL)
- Membership is required for some API calls and further link operations.
- Profile settings page where name, password and API key changes can be made.
- Dashboard of links and statistics page with information about people who visited the shortened link.
- Admin panel where all members and links can be viewed and edited.
- Validation of all form fields & API calls.
- and more...


## Pages
- Homepage(URL Shortener)
- Login/Register/Logout Page
- Profile Settings Page
- API Section
- Dashboard Page
- Stats Page
- Admin Panel

## Installation
> Make sure you've installed Composer
- Open the folder with any editor
- Open ` .env ` and put your database details into it
- Write these lines to editor's terminal or default terminal of your system (make sure you're inside of the folder)  

     1.   ` "php artisan migrate" `
     2.   ` "php artisan db:seed" `
     3.   ` "php artisan serve" `

- That's it, you're ready to use it. Visit: `http://127.0.0.1:8000`

## API
The API has 2 endpoints. You can create a new link through the API or request details of existing links. Membership required for some calls.(to create a new link or to fetch the details of link which belongs to user) API token can be generated from the settings page after logging in.

### **Create New Link**
You must be a member to create a new link via API.
```http
  POST /api/links
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `API_token` | `string` | **Required**|
| `url` | `string` | **Required**|
| `private` | `boolean` | **Required**|
| `email` | `string` | **Required if private is true.**|

**Response**

```json
{
    "error": false,
    "link": {
        "user_id": "1",
        "email": [
            "berkan38212@gmail.com"
        ],
        "short_path": "3QTrbH0",
        "url": "https://github.com/BerkanYesilyurt",
        "private": "1",
        "created_at": "13-08-2022 15:38:33"
    }
}
```


### **Get Details of Link**
Details of all links that do not belong to any user can be viewed. If you want to see the details of the user's link, you must call with that user's API token.

```http
  GET /api/links/{short_path}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :-------------------------------- |
| `API_token`      | `string` | **Required if link belongs a user** |

**Response**

```json
{
    "error": false,
    "link": {
        "user_id": null,
        "email": [
            "berkan38212@gmail.com"
        ],
        "short_path": "H1BqIN5",
        "url": "https://github.com/BerkanYesilyurt",
        "private": 1,
        "created_at": "13-08-2022 15:12:37"
    }
}
```


**Invalid Request's Response (404)**
```json
{
    "error": "Incorrect request!"
}
```

## Screenshots
**Click on the pictures for the original resolution.**

#### Homepage #1
![1](https://user-images.githubusercontent.com/8729215/184247455-37b8c51a-fe24-4f07-8236-05a0d9af608a.png)

#### Homepage #2
![2](https://user-images.githubusercontent.com/8729215/184247461-2ba14497-8dd1-4ea6-9c99-084a0c000f55.png)

#### Login Page
![3](https://user-images.githubusercontent.com/8729215/184247471-3da6b7a9-a59e-4366-972e-4a2c3c1e6d77.png)

#### Register Page
![4](https://user-images.githubusercontent.com/8729215/184247482-2e4fe341-4390-4909-8e56-ee1ed7e8a3e3.png)

#### Profile Settings
![5](https://user-images.githubusercontent.com/8729215/184247493-b6f543ab-211b-49bf-96fc-8c33897ad054.png)

#### Dashboard
![6](https://user-images.githubusercontent.com/8729215/184247498-4ad44e57-4a71-46d1-8ae5-13cdb48f41a5.png)

#### Admin Panel
![7](https://user-images.githubusercontent.com/8729215/184247517-a04475c8-18fe-4c8e-bc22-6bc4a6696441.png)


## Developer
Berkan Yeşilyurt    
berkan38212@gmail.com
