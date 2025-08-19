import React, { useEffect, useState } from 'react';
import api from '../../api';
import MessageForm from './MessageForm';
export default function MessageManagement(){
  const [messages,setMessages] = useState([]);
  const fetch = ()=>api.get('/messages').then(r=>setMessages(r.data)).catch(()=>{});
  useEffect(fetch,[]);
  const del = id=>api.delete(`/messages/${id}`).then(fetch);
  return (
    <div>
      <h4>Messages</h4>
      <MessageForm onSuccess={fetch}/>
      <ul className="list-group mt-3">
        {messages.map(m=>(
          <li className="list-group-item" key={m.id}><strong>{m.sender_id}</strong> → <strong>{m.receiver_id}</strong>: {m.content} <button className="btn btn-sm btn-danger float-end" onClick={()=>del(m.id)}>Delete</button></li>
        ))}
      </ul>
    </div>
  );
}
