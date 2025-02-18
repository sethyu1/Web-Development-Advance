import "./styles.css";
import "mvp.css";
import React, { useState } from "react";
import { useEffect } from "react/cjs/react.production.min";

function DisplayCharacters() {
  const [people, setPeople] = useState([]);

  function fetchPeople() {
    fetch("https://swapi.dev/api/people/")
      .then((response) => response.json())
      .then((playload) => setPeople(playload.results));
  }

  React.useEffect(() => {
    fetchPeople();
  });

  return (
    <div>
      <h2>Star Wars Characters</h2>
      <ul>
        {people.map((person, index) => (
          <li>
            <strong>{person.name}</strong>
            <p>Height: {person.height}</p>
            <p>Gender: {person.gender}</p>
            <p>species: {person.species}</p>
            <p>Films:{person.films}</p>
          </li>
        ))}
      </ul>
    </div>
  );
}
export default function App() {
  return (
    <>
      <DisplayCharacters />
    </>
  );
}
