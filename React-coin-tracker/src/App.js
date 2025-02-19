import "./styles.css";
import "mvp.css";
import React, { useEffect, useState } from "react";

export default function App() {
  const [allData, setAllData] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [searchResult, setSearchResult] = useState([]);
  const [isNightMode, setIsNightMode] = useState(false);

  function fetchData() {
    fetch("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd")
      .then((response) => response.json())
      .then((data) => {
        setAllData(data);
        setSearchResult(data);
      })
      .catch((error) => console.error("Error fetching the data:", error));
  }

  React.useEffect(() => {
    fetchData();
  }, []);

  function handleSearchTerm(event) {
    setSearchTerm(event.target.value);
  }

  function handleSearch() {
    const filteredData = allData.filter((crypto) =>
      crypto.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setSearchResult(filteredData);
  }

  function handleReset() {
    setSearchTerm("");
    fetchData(allData);
  }

  function toggleMode() {
    setIsNightMode((prevMode) => !prevMode);
  }

  function renderCryptoList() {
    return searchResult.map((crypto) => (
      <li className="coin" key={crypto.id}>
        <img src={crypto.image} alt={crypto.name} width={18} />
        <p>{crypto.name}</p>
        <p>${crypto.current_price.toLocaleString()}</p>
        <p>${crypto.market_cap.toLocaleString()}</p>
      </li>
    ));
  }

  return (
    <div className={`App ${isNightMode ? "night-mode" : "day-mode"}`}>
      <div className="header">
        <button className="toggle-btn" onClick={toggleMode}>
          ☀️/🌙
        </button>
        <h1>Top Cryptocurrency</h1>
      </div>

      <input
        type="text"
        placeholder="Search a token"
        value={searchTerm}
        onChange={handleSearchTerm}
      />

      <div className="button-container">
        <button onClick={handleSearch}>Search</button>
        <button onClick={handleReset}>Reset</button>
      </div>

      <ul>
        {searchResult.length > 0 ? (
          renderCryptoList()
        ) : (
          <p>Not Found!(Please Reset)</p>
        )}
      </ul>
    </div>
  );
}
