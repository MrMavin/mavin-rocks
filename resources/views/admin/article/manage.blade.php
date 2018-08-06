@include('form.trumbowyg')

@extends('layouts.admin')

@section('title', 'Manage Article')
@section('page', 'manage-article')

@section('content')
    @php
        $action = ($edit == TRUE) ? route('admin.blog.article.edit', old('id'))
            : route('admin.blog.article.create') ;
    @endphp

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        <div class="level">
            <div class="level-left">
                <h1 class="title">Manage article</h1>

            </div>

            @if ($edit)
                <div class="level-right">
                    <a href="{{ route('admin.blog.article.delete', old('id')) }}"
                       class="form-delete has-text-right">Delete</a>
                </div>
            @endif
        </div>

        @csrf

        @include('form.file', [
            'name' => 'image',
            'label' => 'Choose an image...',
            'fileName' => '640x360.jpg'
        ])

        @include('form.text', [
            'label' => 'Title',
            'type' => 'text',
            'icon' => 'fas fa-pencil-alt',
            'maxlength' => 255
        ])

        @if ($edit)
            @include('form.text', [
            'label' => 'Slug',
            'type' => 'text',
            'icon' => 'fas fa-link',
            'maxlength' => 255
        ])
        @endif

        <div class="content">
            @include('form.textarea', [
                'label' => 'Excerpt'
            ])
        </div>

        <div class="content">
            @include('form.textarea', [
                'label' => 'Content'
            ])
        </div>

        @include('form.text', [
            'label' => 'Tags',
            'type' => 'text',
            'maxlength' => 255
        ])

        @include('form.checkbox', [
            'label' => 'Published',
            'value' => 1
        ])

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
        </div>
    </form>
@endsection