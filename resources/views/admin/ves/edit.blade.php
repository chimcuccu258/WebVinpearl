@extends('layouts.master')
@section('content')
    <a href="{{ route('ves.index') }}">
        <button class="bg-white border border-white p-2 rounded shadow-md text-gray-700 flex items-center focus:outline-none focus:shadow-outline">
            <svg width="24" height="24" viewBox="0 0 16 16">
                <path d="M9 4 L5 8 L9 12" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
            <span class="mx-2">Back</span>
        </button>
    </a>
    <div class="w-2/4 mx-auto pt-2">
        <div class="rounded-sm border border-stroke bg-white shadow-default p-4">
            <div class="border-b border-stroke py-4 px-6.5">
                <h3 class="font-semibold text-black">
                    Sửa Thông Tin Vé
                </h3>
            </div>
            <form action="{{ route('ves.update', $ve) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6.5">

                    <div class="mb-6">
                        <label class="mb-2.5 block text-black font-bold">
                            Loại Dịch Vụ
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select name="maDV" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary">
                                @foreach($dich_vus as $dv)
                                    <option value="{{ $dv->maDV }}" {{ $ve->maDV === $dv->maDV ? 'selected' : '' }}>{{ $dv->tenDV }}</option>
                                @endforeach
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.8">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                                </g>
                                </svg>
                            </span>
                        </div>
                        @if($errors->has('maDV'))
                            <span class="text-red-500">{{ $errors->first('maDV') }}</span>
                        @endif
                    </div>

                    <div class="w-full xl:w-1/2 mb-6">
                        <label class="mb-2.5 block text-black font-bold">
                            Loại Vé
                        </label>
                        <div class="relative z-20 bg-transparent">
                            <select name="loaiVe" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary">
                                <option value="0" @if(old('loaiVe') == '0') selected @endif>Trẻ em</option>
                                <option value="1" @if(old('loaiVe') == '1') selected @endif>Người lớn</option>
                            </select>
                            <span class="absolute top-1/2 right-4 z-30 -translate-y-1/2">
                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g opacity="0.8">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                          </g>
                        </svg>
                      </span>
                        </div>
                        @if($errors->has('loaiVe'))
                            <span class="text-red-500">{{ $errors->first('loaiVe') }}</span>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label class="mb-2.5 block text-black font-bold">
                            Giá Tiền <span class="text-meta-1">*</span>
                        </label>
                        <input name="giaTien" value="{{ old('giaTien', $ve->giaTien) }}" type="giaTien" placeholder="Nhập giá tiền vé" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter">
                        @if($errors->has('giaTien'))
                            <span class="text-red-500">{{ $errors->first('giaTien') }}</span>
                        @endif
                    </div>
                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white transition duration-300 hover:bg-[#0B5ED7]">
                        Cập Nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
