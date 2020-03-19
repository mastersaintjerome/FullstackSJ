import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/local_artwork/';

export default [
  <Route path="/local__artworks/create" component={Create} exact key="create" />,
  <Route path="/local__artworks/edit/:id" component={Update} exact key="update" />,
  <Route path="/local__artworks/show/:id" component={Show} exact key="show" />,
  <Route path="/local__artworks/" component={List} exact strict key="list" />,
  <Route path="/local__artworks/:page" component={List} exact strict key="page" />
];
