# CardiVPN: VPN Admin Panel

**CardiVPN** is a comprehensive VPN admin panel designed for seamless server and user management. It empowers administrators with tools to oversee VPN servers, monitor user activity, and manage subscriptions efficiently.

---

## Features

### 🌐 **Server Management**
- **Server Addition**: Add, edit, and remove VPN servers.
- **Server Monitoring**: View real-time server statuses, including uptime and health checks.
- **Load Balancing**: Distribute user traffic efficiently across multiple servers.

### 🧑‍🤝‍🧑 **User Management**
- **User Profiles**: View and manage user accounts with subscription details.
- **Role-Based Access**: Assign admin, moderator, or user roles.
- **Account Control**: Enable, disable, or delete user accounts.

### 📊 **Dashboard Overview**
- **Server Insights**: View key metrics such as online servers and total bandwidth usage.
- **User Metrics**: Monitor active users and subscription trends.
- **Activity Logs**: Track user logins, purchases, and server activity.

---

## Modules and Functionality

### **Server Management**
- Add servers with essential details like IP address, port, and status.
- Update server information dynamically.
- Monitor server performance to ensure availability.

### **User Management**
- Manage user accounts, including login credentials and subscription details.
- Assign user roles for controlled access.
- Deactivate accounts for security or compliance purposes.

### **Dashboard**
- Get an at-a-glance view of server statuses and user activity.
- Access detailed reports on server load and user engagement.

---

## Installation

### Prerequisites
- PHP 8.2+
- Laravel 11
- MySQL
- Composer
- Node.js

### Steps
1. **Clone the repository**:
    ```bash
    git clone https://github.com/your-username/cardivpn.git
    ```
2. **Navigate to the project directory**:
    ```bash
    cd cardivpn
    ```
3. **Install dependencies**:
    ```bash
    composer install
    ```
4. **Set up environment variables**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5. **Run migrations and seeders**:
    ```bash
    php artisan migrate --seed
    ```
6. **Start the server**:
    ```bash
    php artisan serve
    ```

---

## Usage

### Admin Features
- **Server Management**: Add, edit, and monitor servers.
- **User Control**: Manage user accounts and roles.
- **Dashboard**: Access performance insights for servers and user activity.

### User Features
- **Server Access**: Users can connect to available servers based on their subscription.
- **Profile Management**: Users can update personal information and view account status.

---

## Technologies Used
- **Backend**: Laravel 11
- **Frontend**: Livewire 3, TailwindCSS
- **Database**: MySQL
- **File Handling**: Spatie Media Library

---

## Developer Information
- **Developer**: Sameed
- **Instagram**: [@not_sameed52](https://www.instagram.com/not_sameed52/)
- **Discord**: sameededitz
- **Linktree**: [linktr.ee/sameededitz](https://linktr.ee/sameededitz)
- **Company**: TecClubb
  - **Website**: [https://tecclubb.com/](https://tecclubb.com/)
  - **Contact**: tecclubb@gmail.com

---

## Contributing
We welcome contributions! Fork the repository, create a new branch, and submit a pull request. For larger changes, please open an issue first to discuss.

---

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Contact
For inquiries or support, reach out via:
- **Email**: tecclubb@gmail.com
- **Website**: [https://tecclubb.com/](https://tecclubb.com/)
