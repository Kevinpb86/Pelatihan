import React from 'react';
import ProductList from '../../components/ProductList';

const MyProducts: React.FC = () => {
    return (
        <div className="my-products">
            <h1>My Products</h1>
            <ProductList />
        </div>
    );
};

export default MyProducts;