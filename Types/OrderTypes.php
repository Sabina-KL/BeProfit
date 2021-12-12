<?php
require_once ("AbstractTypes.php");

final class OrderTypes extends AbstractTypes {
    /**
     * @brief table names
     * todo: divide each table to it's own type file
     * @var string
     */
    const TABLE_ORDER_PRICES = 'order_prices';
    const TABLE_ORDER_FINANCIAL_STATUSES = 'order_financial_statuses';
    const TABLE_SHOP_INFO = 'shop_info';
    const TABLE_ADDRESSES = 'order_address';
    const TABLE_ORDERS = 'Orders';
    
    const ID  = 'id';
    const TOTAL_PRICE  = 'total_price';
    const SUBTOTAL_PRICE  = 'subtotal_price';
    const TOTAL_PRODUCTION_COST  = 'total_production_cost';
    const TOTAL_ORDER_SHIPPING_COST  = 'total_order_shipping_cost';
    const TOTAL_ORDER_HANDLING_COST  = 'total_order_handling_cost';
    const TOTAL_DISCOUNTS  = 'total_discounts';
    const FINANCES_STATUS_NAME  = 'name';
    const COUNTRY  = 'country';
    const PROVINCE  = 'province';
    const SHOP_NAME  = 'name';
    const ORDER_ID  = 'order_ID';
    const SHOP_ID  = 'shop_ID';
    const PRICES_ID  = 'Prices_ID';
    const FINANCIAL_STATUS_ID  = 'financial_statuses_ID';
    const ORDER_ADDRESS_ID  = 'order_address_ID';
    const CLOSED_AT  = 'closed_at';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';
    const FULFILMENT_STATUS  = 'fulfillment_status';
    const TOTAL_ITEMS  = 'total_items';
    
    const TYPES = [
        self::ID  => 'id',
        self::TOTAL_PRICE  => 'total_price',
        self::SUBTOTAL_PRICE  => 'subtotal_price',
        self::TOTAL_PRODUCTION_COST  => 'total_production_cost',
        self::TOTAL_ORDER_SHIPPING_COST  => 'total_order_shipping_cost',
        self::TOTAL_ORDER_HANDLING_COST  => 'total_order_handling_cost',
        self::TOTAL_DISCOUNTS  => 'total_discounts',
        self::FINANCES_STATUS_NAME  => 'name',
        self::COUNTRY  => 'country',
        self::PROVINCE  => 'province',
        self::SHOP_NAME  => 'name',
        self::ORDER_ID  => 'order_ID',
        self::SHOP_ID  => 'shop_ID',
        self::PRICES_ID  => 'Prices_ID',
        self::FINANCIAL_STATUS_ID  => 'financial_statuses_ID',
        self::ORDER_ADDRESS_ID  => 'order_address_ID',
        self::CLOSED_AT  => 'closed_at',
        self::CREATED_AT  => 'created_at',
        self::UPDATED_AT  => 'updated_at',
        self::FULFILMENT_STATUS  => 'fulfillment_status',
        self::TOTAL_ITEMS  => 'total_items'
    ];
}
