@extends('layouts.main')
@section('content')
   <div id="filter-items" class="filter-items" style="z-index: 497;">
       <ul class="filter-items-list" style="overflow: visible;">
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active')) ? ' filter-item-active' : '' }}" href="{{ route('orders.active') }}" previewlistener="true">Заказы</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/1')) ? ' filter-item-active' : '' }}" href="/orders/active/1" previewlistener="true">Доставки Сегодня</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/2')) ? ' filter-item-active' : '' }}" href="/orders/active/2" previewlistener="true">Доставки завтра</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/3')) ? ' filter-item-active' : '' }}" href="/orders/active/3" previewlistener="true">Доставки послезавтра</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/4')) ? ' filter-item-active' : '' }}" href="/orders/active/4" previewlistener="true">Доставки позднее</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/5')) ? ' filter-item-active' : '' }}" href="/orders/active/5" previewlistener="true">Отгрузки вчера</a>
            </li>
            <li class="filter-item">
                <a class="filter-item-link {{ (request()-> is('orders/active/6')) ? ' filter-item-active' : '' }}" href="/orders/active/6" previewlistener="true">Отгрузки позавчера</a>
            </li>
        </ul>
    </div>
    
    <h2>Активные заказы</h2>
    <a class="btn btn-items btn-add-item btn-default" href="{{ route('orders.create') }}" role="button">Добавить заказ</a>
    <div class="order-list">
    <table class="table-list">
        <thead>
        <tr class="title-list">
            <th scope="col"></th>
            <th scope="col" style="min-width:54px;">#</th>
            <th scope="col" style="min-width:74px;">Магазин</th>
            <th scope="col" style="min-width:250px;">Ф.И.О.</th>
            <th scope="col" style="min-width:120px;">Телефон</th>
            <th scope="col" style="min-width:250px;">Адрес</th>
            <th scope="col" style="min-width:250px;">Ближайшее метро</th>
            <th scope="col" style="min-width:120px;">Тип доставки</th>
            <th scope="col" style="min-width:250px;">Время отгрузки</th>
            <th scope="col" style="min-width:120px;">Дата отгрузки</th>
            <th scope="col" style="min-width:250px;">Сумма заказа</th>
            <th scope="col" style="min-width:120px;">Подарок</th>
            <th scope="col" style="min-width:350px;">Состав заказа</th>
            <th scope="col" style="min-width:250px;">Примечание</th>
            <th scope="col" style="min-width:200px;">Источник заказа</th>
            <th scope="col" style="min-width:120px;">Статус</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
            <td><form action="{{ route('orders.delete', $order->id) }}" method="post" class="form-inline mr-1 ml-1">
                    <a href="{{ route('orders.edit', $order->id) }} " class="btn btn-action-item">Изменить</a>
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-action-item">Удалить</button>
                </form>
            </td>
            <th scope="row"><a href="{{ route('orders.show', $order->id) }}">{{ $order->number }}</a></th>
            <td>{{ $order->shop->name }}</td>
            <td>{{ $order->fio }}</td>
            <td>{{ $order->telephone }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->underground }}</td>
            <td>{{ $order->delivery->name }}</td>
            <td>{{ $order->timeout }}</td>
            <td>{{ $order->dateout }}</td>
            <td>{{ $order->sum }}</td>
            <td>{{ $order->gift->name }}</td>
            <td>{{ $order->сomposition }}</td>
            <td>{{ $order->note }}</td>
            <td>{{ $order->source->name }}</td>
            <td>{{ $order->status->name }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="mt-3" l>
        {{ $orders->Links() }}
    </div>
    <div width="200" class="menu_order">
        активные 
        <span style="margin: 0 6px;">|</span>
        <a href="{{ route('orders.archive') }}" previewlistener="true">архив </a>                               
        <span style="margin: 0 6px;">|</span>
        <a href="{{ route('orders.deleted') }}" previewlistener="true">удаленные </a>                               
        <span style="margin: 0 6px;">|</span>
        <a href="{{ route('orders.index') }}" previewlistener="true">все </a>
    </div>
@endsection
