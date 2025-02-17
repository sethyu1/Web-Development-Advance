import React, { useState } from "react";
import "mvp.css";
import "./styles.css";

export default function App() {
  const [newItem, setNewItem] = useState("");
  const [toDoItems, setToDoItems] = useState([]);

  function addItem(event) {
    // Binded to form and button
    event.preventDefault();

    const trimmedText = newItem.trim();

    if (trimmedText == "") {
      return;
    }

    const newToDoItem = {
      text: newItem,
      done: false,
      timestamp: Date.now(),
    };

    const newToDoItems = [...toDoItems, newToDoItem];

    setToDoItems(newToDoItems);

    setNewItem("");
  }

  function changeCompletion(toDo) {
    const changedToDoItems = toDoItems.map((item) => {
      if (item.timestamp === toDo.timestamp) {
        item.done = !item.done;
      }

      return item;
    });

    setToDoItems(changedToDoItems);
  }

  function clearCompleted() {
    const filtedToDoItems = toDoItems.filter((item) => !item.done);

    setToDoItems(filtedToDoItems);
  }

  return (
    <>
      <h1>Getting Things Done...</h1>
      <form>
        <input onChange={(e) => setNewItem(e.target.value)} value={newItem} />
        <button onClick={addItem}>Add</button>
      </form>

      <ol>
        {toDoItems.map((toDo) => {
          return (
            <li key={toDo.timestamp}>
              <label>
                <input
                  type="checkbox"
                  checked={toDo.done}
                  onChange={() => changeCompletion(toDo)}
                />
                {toDo.done ? <del>{toDo.text}</del> : toDo.text}
              </label>
            </li>
          );
        })}
      </ol>

      {toDoItems.length > 0 && (
        <button onClick={clearCompleted}>Clear Completed</button>
      )}
    </>
  );
}
