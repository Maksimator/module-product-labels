# Maksimator_ProductLabels

**Magento 2 module to manage and assign custom labels to products.**  
This module allows store administrators to create custom labels, assign them to products via a multiselect field, and display those labels on the product page.

---

## Features

- Admin grid for managing labels (under **Marketing > Product Labels**)
- Multiselect field on product edit page to assign labels
- Labels stored in custom `maksimator_labels` table
- Product-to-label relationships stored in `maksimator_product_labels`
- Observer to handle saving labels when editing a product
- Labels can be rendered on the frontend product page
- Built using Magento UI Components

---

## Installation

### 1. Install via Composer

composer require maksimator/module-product-labels

> Or manually clone the repository and place it under `app/code/Maksimator/ProductLabels`.

### 2. Enable the module

bin/magento module:enable Maksimator_ProductLabels

### 3. Run setup upgrade

bin/magento setup:upgrade

### 4. (Optional) Compile and deploy static content (for production)

bin/magento setup:di:compile
bin/magento setup:static-content:deploy

### 5. Clean cache

bin/magento cache:flush

---

## Usage

### Manage Labels

Navigate to:

Admin Panel > Marketing > Product Labels > Manage Labels

You can create, update, and delete labels in this grid.

### Assign Labels to Products

- Edit any product in the catalog.
- In the **Product Labels** fieldset, use the multiselect to assign labels.
- Save the product — the observer will handle syncing the relation.

### Display Labels on Frontend

The module provides a block that can be included in your product page layout to show assigned labels.  
Default template path:

view/frontend/templates/product/labels.phtml

You can customize or move the block by updating the layout XML.

---

## Module Structure

- **Database Tables**
    - `maksimator_labels` – stores label definitions
    - `maksimator_product_labels` – stores relations between products and labels
- **Admin UI**
    - Grid for managing labels (UI Component)
    - Multiselect on product edit page
- **Frontend**
    - Block to render product labels

---

## Requirements

- Magento 2.4.x or later
- PHP 8.3 or later

---

## License

MIT License.  
See [LICENSE](https://opensource.org/licenses/MIT) for more details.
