import React from 'react';
import { Navbar, Container, Nav } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
export default function TopNav(){ const { user, logout } = useAuth(); return (
  <Navbar bg="light" expand="lg" className="mb-3"><Container><Navbar.Brand as={Link} to="/">Vendor Portal</Navbar.Brand>
  <Navbar.Toggle aria-controls="basic-navbar-nav" />
  <Navbar.Collapse id="basic-navbar-nav"><Nav className="me-auto">
    {user?.role==='admin' && <Nav.Link as={Link} to="/admin">Admin</Nav.Link>}
    {user?.role==='procurement' && <Nav.Link as={Link} to="/procurement">Procurement</Nav.Link>}
    {user?.role==='finance' && <Nav.Link as={Link} to="/finance">Finance</Nav.Link>}
    {user?.role==='vendor' && <Nav.Link as={Link} to="/vendor">Vendor</Nav.Link>}
  </Nav><Nav>{!user && <Nav.Link as={Link} to="/login">Login</Nav.Link>}{user && <Nav.Link onClick={logout}>Logout</Nav.Link>}</Nav></Navbar.Collapse></Container></Navbar>
); }
