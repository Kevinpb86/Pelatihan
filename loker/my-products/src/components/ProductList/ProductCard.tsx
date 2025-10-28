const React from 'react';
import './styles.css';

interface ProductCardProps {
    id: number;
    name: string;
    price: number;
    image: string;
}

const ProductCard: React.FC<ProductCardProps> = ({ id, name, price, image }) => {
    return (
        <div className="product-card" key={id}>
            <img src={image} alt={name} className="product-image" />
            <h3 className="product-name">{name}</h3>
            <p className="product-price">${price.toFixed(2)}</p>
        </div>
    );
};

export default ProductCard;