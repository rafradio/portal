import React, { useState, useEffect } from 'react';
import MenuItem from './MenuItem';

const NestedMenu = () => {
  const [menuData, setMenuData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchMenuData = async () => {
      try {
        const response = await fetch('/menutest');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        setMenuData(data);
      } catch (err) {
        setError(err.message);
        console.error('Error fetching menu data:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchMenuData();
  }, []);

  

  if (loading) {
    return (
      <div className="p-6">
        <div className="animate-pulse">
          <div className="h-6 bg-gray-200 rounded w-32 mb-4"></div>
          <div className="h-4 bg-gray-200 rounded w-24 mb-2"></div>
          <div className="h-4 bg-gray-200 rounded w-20"></div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="p-6">
        <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          <strong>Ошибка!</strong> Не удалось загрузить меню: {error}
        </div>
      </div>
    );
  }

  if (!menuData || menuData.length === 0) {
    return (
      <div className="p-6">
        <div className="text-gray-500">Меню пусто</div>
      </div>
    );
  }

  return (
    <nav className="w-full max-w-sm mx-auto">
      <ul className="space-y-1">
        {menuData.map((item, index) => (
          <MenuItem key={index} item={item} />
        ))}
      </ul>
    </nav>
  );
};

export default NestedMenu;