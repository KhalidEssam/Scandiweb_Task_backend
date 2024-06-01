# E-commerce Backend

This is the backend for the E-commerce application, built with PHP, using a GraphQL endpoint located at (src/graphql.php), Doctrine ORM, and dotenv for environment configuration.

## Requirements

- PHP 7.4 or higher
- XAMPP / WAMP
- Composer
- MySQL

## Tree

C:.
|   .env
|   .gitignore
|   bootstrap.php
|   composer.json
|   composer.lock
|   README.md
|
+---bin
|       doctrine.php
|
+---src
|   |   create_product_test.php
|   |   graphql.php
|   |
|   +---graphql
|   |   |   GraphQLServer.php
|   |   |
|   |   +---mutations
|   |   |       MutationType.php
|   |   |       OrderMutationType.php
|   |   |
|   |   +---ORMResolvers
|   |   |   |   AbstractQueryResolver.php
|   |   |   |   AttributeQueryResolver.php
|   |   |   |   CategoryNameQueryResolver.php
|   |   |   |   CategoryQueryResolver.php
|   |   |   |   GalleryQueryResolver.php
|   |   |   |   PriceQueryResolver.php
|   |   |   |   ProductQueryResolver.php
|   |   |   |
|   |   |   \---mutationResolvers
|   |   |           CreateOrder.php
|   |   |           OrderService.php
|   |   |
|   |   +---PDOResolvers
|   |   |       AbstractQueryResolver.php
|   |   |       AttributeQueryResolver.php
|   |   |       CategoryNameQueryResolver.php
|   |   |       CategoryQueryResolver.php
|   |   |       GalleryQueryResolver.php
|   |   |       PriceQueryResolver.php
|   |   |       ProductQueryResolver.php
|   |   |
|   |   \---schemas
|   |           AttributeSetTypeDefinition.php
|   |           BaseTypeDefinition.php
|   |           CategoryTypeDefinition.php
|   |           CurrencyTypeDefinition.php
|   |           GraphQLSchema.php
|   |           ItemTypeDefinition.php
|   |           PriceTypeDefinition.php
|   |           ProductTypeDefinition.php
|   |
|   +---models
|   |   |   Database.php
|   |   |
|   |   \---ORMEntities
|   |           AttributeEntity.dcm.xml
|   |           AttributeEntity.php
|   |           AttributeItem.dcm.xml
|   |           AttributeItem.php
|   |           CategoryEntity.dcm.xml
|   |           CategoryEntity.php
|   |           Currency.dcm.xml
|   |           Currency.php
|   |           OrderDetailEntity.dcm.xml
|   |           OrderDetailEntity.php
|   |           OrderEntity.dcm.xml
|   |           OrderEntity.php
|   |           PriceEntity.dcm.xml
|   |           PriceEntity.php
|   |           Product.dcm.xml
|   |           Product.php
|   |           Product_Attribute.dcm.xml
|   |           Product_Attribute.php
|   |           product_image.dcm.xml
|   |           product_image.php
|   |
|   \---proxies
|           __CG__AttributeEntity.php
|           __CG__AttributeItem.php
|           __CG__CategoryEntity.php
|           __CG__Currency.php
|           __CG__OrderDetailEntity.php
|           __CG__OrderEntity.php
|           __CG__PriceEntity.php
|           __CG__Product.php
|           __CG__Product_Attribute.php
|           __CG__product_image.php
|
\---vendor
    |   autoload.php
    .
    .
    .
    .
    .
    .
    .
    .
    .
    .
    .
    .


## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://bitbucket.org/fullstack-scandiweb-test/backend/src/master/.git
cd ecommerce-backend
composer install
composer update
composer dump-autoload
php bin/doctrine.php orm:schema-tool:create
php bin/doctrine.php orm:schema-tool:update --force --dump-sql
php bin/doctrine.php  orm:generate:proxies
