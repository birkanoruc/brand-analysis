# Laravel Excel Upload and Brand Analysis Project

This project allows users to upload Excel files and automatically generates limited analysis pages based on the uploaded data. It is built using Laravel and includes an admin panel powered by AdminLTE.

## Installation

### Step 1: Clone the repository

First, clone this repository to your local machine:

```bash
git clone https://github.com/birkanoruc/brand-analysis.git
```

and go to project directory:

```bash
cd brand-analysis
```

### Step 2: Install dependencies

After cloning, run composer install to install all the necessary PHP dependencies:

```bash
composer install
```

### Step 3: Install AdminLTE

Once the dependencies are installed, use the following command to install the AdminLTE package for the admin panel interface:

```bash
php artisan adminlte:install
```

### Step 4: Set up environment variables

Make a copy of the .env.example file and rename it to .env. Update your database credentials and other configurations as needed:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### Step 5: Run Migrations

Run the following command to create the necessary database tables:

```bash
php artisan migrate
```

### Step 6: Serve the Application

Finally, start the Laravel development server:

```bash
php artisan serve
```

Your application should now be running at http://localhost:8000.

## Enabling User Registration

To enable user registration in your application, uncomment the following line in your routes/web.php file:

```php
// Auth::routes();
```

If you want to disable the registration page later, you can simply comment this line again.

## Admin Panel

### Uploads

This is the page where you can upload Excel files.

### Brands

You must enter the full name of the brand you wish to analyze in Excel.

**Important:** The first row of the Excel file should contain general column names. For brands, the column name must specifically be “markalar.”

### Categories

You must provide the name of the column in Excel that contains the data to be calculated, and fill in the “options” field as a JSON object.

**Example for Options:**
{
"adet" : "++",
"erisim" : "+=",
"rees_try" : "+=",
"stxcm" : "+="
}

**adet:** This is the general name of the column in the first row of Excel.
**++:** Increments the value by 1 for each occurrence.
**+=:** Adds up the data for each occurrence.

### Analysis

To perform an analysis:

    1.	Choose the brand you want to analyze and select the uploaded Excel files along with the matching categories.
    2.	Fill in the “Analysis Date” field.
    3.	Create the analysis.
    4.	Go to the “Analysis List” screen, click the “Analysis” button to view the results.

## License

This project is licensed under the MIT License.
