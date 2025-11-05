import React, { useState, useEffect } from 'react';

const MenuItem = ({ item }) => {
    const [isOpen, setIsOpen] = useState(false);

    const hasChildren = item.children && item.children.length > 0;

    return (
      <li className="mb-1">
        <div className="flex items-center">
          <button
            onClick={() => hasChildren && setIsOpen(!isOpen)}
            className={`flex items-center w-full text-left px-4 py-2 rounded-md transition-colors duration-200 ${
              hasChildren
                ? 'hover:bg-gray-100 focus:bg-gray-100 focus:outline-none'
                : 'hover:bg-gray-50 focus:bg-gray-50 focus:outline-none'
            }`}
          >
            {hasChildren && (
              <span className="mr-2 text-gray-500">
                {isOpen ? '▼' : '►'}
              </span>
            )}
            <span className="text-gray-700 font-medium">{item.name || item.title || item.label || 'Untitled'}</span>
          </button>
        </div>

        {hasChildren && isOpen && (
          <ul className="ml-6 mt-1 border-l-2 border-gray-200 pl-2">
            {item.children.map((child, index) => (
              <MenuItem key={index} item={child} />
            ))}
          </ul>
        )}
      </li>
    );
  };
  
  export default MenuItem;
